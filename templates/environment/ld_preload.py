from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("")
#libc = ELF("")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}


p = process("")
p.interactive()

