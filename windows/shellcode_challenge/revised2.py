import ctypes, struct
from keystone import *

# Example x86 assembly code
CODE = (
    " start:                             "  
    "   int3                            ;"
    "   mov   ebp, esp                  ;"
    "   sub   esp, 60h                  ;"

    " find_kernel32:                     "
    "   xor   ecx, ecx                  ;"
    "   mov   esi, fs:[ecx+30h]         ;"
    "   mov   esi, [esi+0Ch]            ;"
    "   mov   esi, [esi+1Ch]            ;"

    " next_module:                      "
    "   mov   ebx, [esi+8h]             ;"
    "   mov   edi, [esi+20h]            ;"
    "   mov   esi, [esi]                ;"
    "   cmp   [edi+12*2], cx            ;"
    "   jne   next_module               ;"
    "   ret                             ;"
)

# Initialize Keystone engine in X86-32bit mode
ks = Ks(KS_ARCH_X86, KS_MODE_32)
encoding, count = ks.asm(CODE)
print(f"Encoded {count} instructions...")

# Convert encoding to bytearray
shellcode = bytearray(struct.pack(f"{len(encoding)}B", *encoding))

# Allocate memory for the shellcode
ptr = ctypes.windll.kernel32.VirtualAlloc(
    ctypes.c_void_p(0),
    ctypes.c_size_t(len(shellcode)),
    ctypes.c_uint32(0x3000),  # MEM_COMMIT | MEM_RESERVE
    ctypes.c_uint32(0x40)     # PAGE_EXECUTE_READWRITE
)

# Check if VirtualAlloc succeeded
if not ptr:
    raise MemoryError("Failed to allocate memory with VirtualAlloc")

print(f"Allocated memory at {hex(ptr)}")

# Create a buffer and copy shellcode into the allocated memory
buf = (ctypes.c_char * len(shellcode)).from_buffer(shellcode)

# Ensure the destination pointer is correctly cast
dest_ptr = ctypes.c_void_p(ptr)

# Use RtlMoveMemory to copy the shellcode into allocated memory
try:
    ctypes.windll.kernel32.RtlMoveMemory(
        dest_ptr,
        ctypes.cast(buf, ctypes.c_void_p),
        ctypes.c_size_t(len(shellcode))
    )
except OSError as e:
    print(f"Error during RtlMoveMemory: {e}")
    raise

print(f"Shellcode copied to {hex(ptr)}")
input("Press ENTER to execute the shellcode...")

# Create a thread to execute the shellcode
ht = ctypes.windll.kernel32.CreateThread(
    ctypes.c_void_p(0),
    ctypes.c_size_t(0),
    dest_ptr,
    ctypes.c_void_p(0),
    ctypes.c_uint32(0),
    ctypes.pointer(ctypes.c_uint32(0))
)

# Check if thread creation succeeded
if not ht:
    raise RuntimeError("Failed to create thread with CreateThread")

# Wait for the thread to finish execution
ctypes.windll.kernel32.WaitForSingleObject(
    ctypes.c_void_p(ht), 
    ctypes.c_uint32(-1)
)

