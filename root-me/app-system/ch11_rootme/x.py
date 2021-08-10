from pwn import *





s = ssh(host='challenge02.root-me.org', port=2222, user='app-systeme-ch11', password='app-systeme-ch11')

p = s.process(['./ch11'])
p.interactive()
