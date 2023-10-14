section .data

path:	db	"flag.txt", 0

section .text
    global _start

_start:
    ; Push the file name onto the stack




    ; Open the file
    mov rdi, path
    mov rax, 2          ; System call number for open
    mov rsi, 0          ; Flags: O_RDONLY
    xor rdx, rdx        ; Mode: 0 (ignored for read-only)
    syscall             ; Call the kernel

    push rax
    sub rsp, 16


    ; Read from the file
    mov rdi, [rsp+16]   ; File descriptor from the open call
    mov rax, 0          ; System call number for read
    mov rsi, rsp	; Pointer to the buffer on the stack
    mov rdx, 16       ; Number of bytes to read
    syscall             ; Call the kernel

    ; Write the read data to stdout
    mov rax, 1          ; System call number for write
    mov rdi, 1          ; File descriptor 1 (stdout)
    mov rsi, rsp        ; Pointer to the buffer on the stack
    mov rdx, 16        ; length
    syscall             ; Call the kernel

exit:
    ; Exit the program
    mov rax, 60         ; System call number for exit
    xor rdi, rdi        ; Exit status 0
    syscall             ; Call the kernel

