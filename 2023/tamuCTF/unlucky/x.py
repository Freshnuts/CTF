from pwn import *
import random

context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./unlucky")
#libc = ELF("")
#env = {"LD_PRELOAD": "./libc.so.6"}

#p = process('./unlucky')
p = remote("tamuctf.com", 443, ssl=True, sni="unlucky")
#p = gdb.debug("./unlucky", gdbscript='''
#b *main''')

p.recvuntil(b'lucky number: ')

luckyNum = p.recvline().strip()
num = int.from_bytes(luckyNum, byteorder='little') + 11971

print('main: ', luckyNum)
print('main int: ', int(luckyNum,16))
print('seed: ', num)


p.recvline()
p.interactive()
