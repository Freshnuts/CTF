import struct
import sys


def p(x):
    return struct.pack('<L', x)


# empty payload
payload = ""

# padding = print "A" * 44
payload += "A" * 8


payload += "B" * 6

sys.stdout.write(payload)
