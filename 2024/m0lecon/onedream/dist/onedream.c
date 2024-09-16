#include <linux/miscdevice.h>
#include <linux/fs.h>
#include <linux/init.h>
#include <linux/kernel.h>
#include <linux/module.h>
#include <linux/kallsyms.h>
#include <asm/patching.h>

struct params {
    u64 where;
    u8 what;
};

static bool done = false;

DEFINE_MUTEX(g_mutex);

static u64 forbidden_dreams[][2] = {
    {0, 0},
    {(u64)PAGE_OFFSET, (u64)PAGE_END},
    {(u64)VMEMMAP_START, (u64)VMEMMAP_END}
};

static bool dream_allowed(u64 addr) {
    for (size_t i = 0; i < sizeof(forbidden_dreams) / sizeof(forbidden_dreams[0]); i++)
        if (addr >= forbidden_dreams[i][0] && addr < forbidden_dreams[i][1])
            return false;            
    return true;
}

static long onedream_ioctl(struct file *filp, unsigned int cmd, unsigned long arg) {
    struct params p;
    int ret = 0;

    if (copy_from_user(&p, (void*)arg, sizeof(p)))
        return -EINVAL;

    mutex_lock(&g_mutex);

    if (!done && dream_allowed(p.where)) {
		/* Time to dream 🍼 */
        u32 what = (*(u32*)p.where & ~0xff) | p.what;
        ret = aarch64_insn_patch_text_nosync((void*)p.where, what);
        done = true;
    }

    mutex_unlock(&g_mutex);

    return ret;
}

static struct file_operations onedream_fops = {
    .owner = THIS_MODULE,
    .unlocked_ioctl = onedream_ioctl
};

static struct miscdevice onedream_dev = {
    .minor = MISC_DYNAMIC_MINOR,
    .name  = "onedream",
    .fops  = &onedream_fops
};

static int __init onedream_init(void) {
    forbidden_dreams[0][0] = kallsyms_lookup_name("_text");
    forbidden_dreams[0][1] = kallsyms_lookup_name("_end");

    if (!forbidden_dreams[0][0] || !forbidden_dreams[0][1]) {
        pr_err("Sorry the kernel is having a nightmare\n");
        return -1;
    }

    if (misc_register(&onedream_dev)) {
		pr_err("misc_register failed\n");
        return -1;
	}

	return 0;
}

static void __exit onedream_exit(void) {
	misc_deregister(&onedream_dev);
}

module_init(onedream_init);
module_exit(onedream_exit);

MODULE_AUTHOR("Bonfee");
MODULE_LICENSE("GPL");
MODULE_DESCRIPTION("One dream");
