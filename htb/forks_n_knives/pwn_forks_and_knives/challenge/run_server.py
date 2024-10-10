from pwn import *
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
#context.binary = "./server"
#binary = ELF("server")
#libc = ELF("")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}

#p = process("./server")
p = gdb.debug("./server", '''
''')

p.interactive()
