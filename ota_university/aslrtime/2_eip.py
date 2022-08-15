import struct
import sys


def p(x):
    return struct.pack('<Q', x)



payload = ""

payload += "A" * 16 + "B" * 6


sys.stdout.write(payload)
