section .data
    path db '.'

section .text
    global _start

_start:
    ; Open current directory
    mov rdi, path        ; Path to the directory
    mov rax, 2           ; sys_open system call number
    xor rsi, rsi         ; O_RDONLY mode
    xor rdx, rdx         ; File permissions (ignored for O_RDONLY)
    syscall

    ; Read directory entries
    mov rdi, rax         ; File descriptor returned by sys_open
    lea rsi, [rsp]       ; Pointer to the buffer for directory entries
    mov rdx, 255         ; Buffer size
    mov rax, 217         ; sys_getdents system call number
    syscall

    ; Print filenames
    mov rsi, rsp         ; Pointer to directory entries
    print_file:
        mov rdi, 1        ; File descriptor (stdout)
        lea rdx, [rsi + 18] ; Filename is at offset 18
        syscall

        mov rax, 1        ; sys_write system call number
        mov rdi, 1        ; File descriptor (stdout)
        lea rsi, [newline] ; Newline character
        mov rdx, 1        ; Length of newline
        syscall

    next_entry:
        add rsi, [rsi]    ; Move to the next directory entry
        jnz print_file    ; Continue if there is another entry

    ; Exit the program
    mov rax, 60          ; sys_exit system call number
    xor rdi, rdi         ; Exit code 0
    syscall

section .data
    newline db 10         ; Newline character

