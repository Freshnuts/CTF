section .data
    hello db 'Hello, World!',0

section .text
    global _start

_start:
    ; Write 'Hello, World!' to stdout (file descriptor 1)
    mov rax, 1
    mov rdi, 1
    mov rsi, hello
    mov rdx, 13
    syscall

    ; Exit the program
    mov rax, 60
    xor rdi, rdi
    syscall

