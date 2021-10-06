import struct
import sys


def p(x):
    return struct.pack('<L', x)


# empty payload
payload = ""

# padding = print "A" * 44
payload += "A" * 14


sys.stdout.write(payload)
