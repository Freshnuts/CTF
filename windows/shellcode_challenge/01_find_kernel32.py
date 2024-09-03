import ctypes, struct
import os
from keystone import *

def main():
    
    SHELLCODE = (
    " start:                             "  #
    "   int3                            ;"  #   Breakpoint for Windbg. REMOVE ME WHEN NOT DEBUGGING!!!!
    "   mov   ebp, esp                  ;"  #
    "   sub   esp, 0x60h                  ;"  #

    " find_kernel32:                     "  #
    "   xor   ecx, ecx                  ;"  #   ECX = 0
    "   mov   esi,fs:[ecx+0x30]         ;"  #   ESI = &(PEB) ([FS:0x30])
    "   mov   esi,[esi+0Ch]             ;"  #   ESI = PEB->Ldr
    "   mov   esi,[esi+1Ch]             ;"  #   ESI = PEB->Ldr.InInitOrder

    " next_module:                      "  #
    "   mov   ebx, [esi+8h]             ;"  #   EBX = InInitOrder[X].base_address
    "   mov   edi, [esi+20h]            ;"  #   EDI = InInitOrder[X].module_name
    "   mov   esi, [esi]                ;"  #   ESI = InInitOrder[X].flink (next)
    "   cmp   [edi+12*2], cx            ;"  #   (unicode) modulename[12] == 0x00 ?
    "   jne   next_module               ;"  #   No: try next module.
    "   ret                             ;"  #
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
