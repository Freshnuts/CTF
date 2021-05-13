from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./simplecalc')
gdb.attach(p,'''
break *0x4013ff
''')

buf = ''
buf += 'AAAA'

# Number of Calcs
p.recvline()
p.sendline('50')

# 'Add' Menu Option
p.recvline()
p.sendline('1')

# First argument
p.recvline()
p.sendline('123123123')


# 2nd Argument
p.recvline()
p.sendline('123123123')

# 'Save & Exit' Menu Option
p.recvline()
p.sendline('5')

p.interactive()
