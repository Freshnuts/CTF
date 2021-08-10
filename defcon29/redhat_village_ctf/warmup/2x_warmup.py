from pwn import *


p = gdb.debug("./target")
p.interactive()
