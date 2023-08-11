from pwn import *
import time
import re


p = remote('netcat-pwn.wanictf.org', 9001)

for i in range(3):
    data = p.recvuntil(b'=')
    
    data = data.decode()
    
    last10 = data[-12:]
    last10strip = last10.replace('=','')
    print(last10strip)
    
    result = eval(last10strip)
    print(b'Send result: ', result)
    
    time.sleep(1)
    p.sendline(str(result))

    print(p.recvline())
    congrats = p.recvline().rstrip()
    if congrats:
        print(congrats)
        p.sendline(b'cat FLAG')
        print(p.recvline()).rstrip()

p.interactive()


