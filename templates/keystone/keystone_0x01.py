from keystone import *

CODE = (
"                        " 
" start:                 "
"     xor eax, eax      ;" 
"     add eax, ecx      ;" 
"     push eax          ;" 
"     pop esi           ;" 
)

# Initialize engine in 32-bit mode
ks = Ks(KS_ARCH_X86, KS_MODE_32)
encoding, count = ks.asm(CODE)
instructions = ""
for dec in encoding: 
    instructions += "\\x{0:02x}".format(int(dec)).rstrip("\n")
  
print("Opcodes = (\"" + instructions + "\")")
