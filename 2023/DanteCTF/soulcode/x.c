section .text
global _start

_start:

        ; 59 execv('/bin/sh\x00', 0, 0)
        mov rdi, binsh
        mov rsi, 0
        mov rdx, 0
        mov rax, 0x3b
        syscall

section .data
binsh db '/bin/sh'
