from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}

s = ssh(host='challenge05.root-me.org', user='app-systeme-ch73', password='app-systeme-ch73', port=2225)
p = s.process('./ch73.exe')


p.interactive()
