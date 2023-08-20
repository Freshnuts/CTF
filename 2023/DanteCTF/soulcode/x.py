from pwn import *


f = 'flag.txt'

shellcode = shellcraft.cat(f) + shellcraft.exit(0)

ass = run_assembly(shellcode)

print(shellcode)


