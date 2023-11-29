section .data
    dir_path db '.'

section .text
    global _start

    extern prctl
    extern seccomp_init
    extern seccomp_rule_add
    extern seccomp_load
    extern open
    extern fstat
    extern close
    extern getdents64
    extern readdir

_start:
    ; Set up seccomp filter
    mov edi, 22                  ; SECCOMP_SET_MODE_FILTER
    xor esi, esi                 ; Strict mode
    call prctl

    ; Initialize seccomp filter context
    mov rdi, SCMP_ACT_KILL       ; default action: kill
    call seccomp_init

    ; Allow specific syscalls
    mov rdi, SCMP_ACT_ALLOW
    mov rsi, SCMP_SYS(open)
    mov rdx, 0
    call seccomp_rule_add

    mov rsi, SCMP_SYS(fstat)
    call seccomp_rule_add

    mov rsi, SCMP_SYS(close)
    call seccomp_rule_add

    mov rsi, SCMP_SYS(getdents64)
    call seccomp_rule_add

    ; Load the filter
    call seccomp_load

    ; Open the current directory
    mov rdi, dir_path            ; Path to the directory
    mov rsi, O_RDONLY            ; O_RDONLY mode
    call open
    mov r8, rax                   ; Save file descriptor

    ; Read directory entries
    lea rdi, [rsp]               ; Buffer for directory entries
    mov rsi, 255                 ; Buffer size
    mov rdx, r8                  ; File descriptor returned by sys_open
    call getdents64

    ; Loop through directory entries
    mov rdi, rax                  ; Number of bytes read
    lea rsi, [rsp]                ; Pointer to directory entries
    mov r8, 0                     ; Initialize offset

print_file:
    mov rdi, 1                    ; File descriptor (stdout)
    lea rdx, [rsi + r8 + 18]      ; Filename is at offset 18
    call write

    ; Print newline
    mov rdi, 1                    ; File descriptor (stdout)
    lea rsi, [newline]
    mov rdx, 1
    call write

    ; Move to the next directory entry
    add r8, [rsi + r8]

    ; Continue if there is another entry
    test r8, r8
    jnz print_file

    ; Close the directory
    mov rdi, rdx                  ; File descriptor
    call close

    ; Exit the program
    mov rax, 60                   ; sys_exit system call number
    xor rdi, rdi                  ; Exit code 0
    syscall

section .data
    newline db 10                  ; Newline character

