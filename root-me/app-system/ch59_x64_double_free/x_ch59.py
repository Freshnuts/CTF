from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./what_does_the_f_say")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}

s = ssh(host='challenge03.root-me.org ', user='app-systeme-ch59', password='app-systeme-ch59', port=2223)
p = s.process('./ch73.exe')


# malloc()
# free()
# free()
# malloc()


p.interactive()
