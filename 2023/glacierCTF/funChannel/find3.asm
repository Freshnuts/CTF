section .data
    path db '.'

section .text
    global _start

    ; Constants for syscalls
    SYS_openat equ 257
    SYS_getdents equ 78
    SYS_read equ 0
    SYS_write equ 1
    SYS_close equ 3
    SYS_exit equ 60
    STDOUT equ 1

_start:
    ; Open the current directory
    mov rdi, 0                  ; fd: AT_FDCWD (current directory)
    mov rsi, path               ; pathname: "."
    mov rdx, 0                  ; flags: 0
    mov rax, SYS_openat         ; syscall: openat
    syscall
    mov r8, rax                  ; Save directory handle

    ; Read directory entries
    lea rdi, [rsp]               ; buf: buffer for directory entries
    mov rsi, 4096                ; count: buffer size
    mov rdx, r8                  ; fd: directory handle
    mov rax, SYS_getdents        ; syscall: getdents
    syscall

    ; Loop through directory entries
    lea rsi, [rsp]               ; Pointer to directory entries
    mov r8, 0                     ; Initialize offset

read_file:
    ; Get directory entry length
    mov r9, [rsi + r8]

    ; Check if there are no more entries
    test r9, r9
    jz done

    ; Print the filename
    lea rdi, [rsi + r8 + 24]     ; d_name is at offset 24
    mov rsi, r9                  ; Length of the filename
    mov rdx, STDOUT              ; fd: stdout
    mov rax, SYS_write           ; syscall: write
    syscall

    ; Print newline
    mov rdi, STDOUT              ; fd: stdout
    lea rsi, [newline]
    mov rdx, 1
    mov rax, SYS_write           ; syscall: write
    syscall

    ; Move to the next directory entry
    add r8, r9
    jmp read_file

done:
    ; Close the directory
    mov rdi, r8                  ; fd: directory handle
    mov rax, SYS_close           ; syscall: close
    syscall

    ; Exit the program
    mov rax, SYS_exit            ; syscall: exit
    xor rdi, rdi                 ; Exit code 0
    syscall

section .data
    newline db 10                 ; Newline character

