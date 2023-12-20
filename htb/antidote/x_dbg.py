from pwn import *
# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
context.arch = 'arm'

# gdbserver --wrapper env 'LD_PRELOAD=./libc.so.6' -- :2000 ./antidote

#p = remote('192.168.0.19', 2000)
p = process('./antidote')
gdb.attach(p, '''
target remote 192.168.0.19:2000
break *main
break *main+104
break *main+124
''')

p.recv()
p.interactive()
