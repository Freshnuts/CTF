section .text

global _start

_start:

; open file
    xor     rax, rax
    xor     rdi, rdi
    mov     rdi, 0x46414c47
    push    rdi
    mov     rdi, rsp
    mov     al, 2
    xor     rsi, rsi
    syscall

; save file descriptor
    mov     rdi, rax

; read file
    xor     rax, rax
    mov     rdi, rax
    mov     rdx, rax
    mov     rsi, rsp
    mov     al, 0
    syscall

; write file content to stdout
    mov     rdx, rax
    mov     rsi, rsp
    xor     rax, rax
    mov     rdi, 1
    syscall

; exit
    xor     rax, rax
    mov     al, 60
    xor     rdi, rdi
    syscall
