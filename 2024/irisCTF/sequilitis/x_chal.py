from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}

''' 
remote#: gdbserver localhost:1234 ./chal
remote#: SELECT name FROM sqlite_master WHERE type='table';


1. Insert sqlite3 prepared statement correctly

SELECT name FROM 'sqlite_master' WHERE type='table';


'''

p = process("./chal")
#p = remote("172.17.0.2", 1234)
gdb.attach(p,'''
target remote 172.17.0.2:1234
b *main
''')

p.recvline()
p.interactive()
