from pwn import *
import sys

# Connect to the SSH server
s = ssh('app-systeme-ch10', 'challenge02.root-me.org', password='app-systeme-ch10', port=2222)

# Start a process on the server
#p = s.process('./ch10')

#gdb.attach(p, 'break main')
# Attach a debugger to it
p = gdb.debug(['./ch10'], ssh=s, set sysroot, gdbscript='''
break main
''')

p.interactive()
# Cause `p` to exit
# p.close()

