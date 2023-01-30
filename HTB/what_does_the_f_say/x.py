from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./restaurant")
s = remote('138.68.182.130', 30191)
#p = s.process("./what_does_the_f_say")
gdb.attach(s, "break *main")

p.interactive()
