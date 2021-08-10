import struct


def p(x):
    return struct.pack('<L', x)


# empty payload
payload = ""

#padding
payload += "A" * 32
payload += "B" * 4

 
print payload
