from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./storytime")
#libc = ELF("")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}

p = process("./storytime", env=env)
#p = gdb.debug("./storytime", '''
#break main
#break *0x40069c
#''', env=env)

p.interactive()
