import struct
import sys


payload = ""
payload += "A" * 32
payload += "B" * 2000


sys.stdout.write(payload)
