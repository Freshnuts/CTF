from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}

#s = ssh(host='challenge05.root-me.org', user='app-systeme-ch74', password='app-systeme-ch74', port=2225)

s = ssh(user='app-systeme-ch74', host='challenge05.root-me.org', password='app-systeme-ch74',port=2225, ssh_agent=True)
p = s.process('./ch74.exe')



p.interactive()
