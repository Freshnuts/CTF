section .data
    directory db '.'      ; Current directory
    flag_ext db '.txt'    ; File extension to match
    buf_size equ 256       ; Buffer size

section .bss
    filename resb buf_size ; Buffer for filename

section .text
    global _start

_start:
    ; Open the current directory
    mov rdi, directory     ; pointer to the directory name
    mov rax, 2             ; sys_open system call number
    mov rsi, 0             ; O_RDONLY mode
    syscall

    ; Read directory entries
    mov rdi, rax           ; file descriptor returned by sys_open
    mov rsi, filename      ; pointer to the buffer for directory entries
    mov rdx, buf_size      ; size of the buffer
    mov rax, 217           ; sys_getdents system call number
    syscall

    ; Loop through directory entries
    mov rax, 0            ; Loop counter
    jmp find_file         ; Jump to find_file label

check_file:
    ; Check if the entry is a regular file
    mov al, [rsi]        ; d_type field is at the offset 0
    cmp al, 8             ; DT_REG constant indicating a regular file
    jne next_entry

    ; Check if the file ends with '.txt'
    mov rdi, rsi
    call ends_with_txt    ; Call the function to check file extension

    ; If the function returns zero, the file has the correct extension
    test rax, rax
    jz found_flag

next_entry:
    ; Move to the next directory entry
    mov rax, [rsi + 8]    ; d_off field is at the offset 8
    add rsi, rax
    jmp find_file

found_flag:
    ; Print the filename
    mov rax, 1             ; sys_write system call number
    mov rdi, 1             ; file descriptor 1 (stdout)
    mov rsi, filename
    mov rdx, buf_size
    syscall

    ; Close the directory
    mov rax, 3             ; sys_close system call number
    mov rdi, rdi           ; file descriptor returned by sys_open
    syscall

    ; Exit the program
    mov rax, 60            ; sys_exit system call number
    xor rdi, rdi           ; Exit code 0
    syscall

find_file:
    ; Move to the next directory entry
    add rsi, rax

    ; Check if the end of directory entries is reached (entry length is zero)
    mov rax, [rsi]
    test rax, rax
    jz done

    ; Increment the loop counter
    inc dword [rax]
    jmp check_file

done:
    ; The program should never reach this point

; Function to check if the string in rdi ends with '.txt'
; Input: rdi - pointer to the string
; Output: ZF (zero flag) set if the string ends with '.txt'
ends_with_txt:
    mov rcx, 0             ; Counter for comparing characters
.next_char:
    cmp byte [rdi + rcx], 0 ; Check if the current character is null (end of string)
    je .not_found          ; If null, the string doesn't end with '.txt'
    cmp byte [rdi + rcx], '.' ; Compare the current character with '.'
    jne .not_found         ; If not '.', continue checking
    mov rbx, flag_ext      ; Pointer to '.txt'
    add rbx, rcx           ; Adjust the pointer to compare with the current character
    cmp byte [rbx], 0      ; Check if the character in flag_ext is null
    je .found              ; If null, the string ends with '.txt'
    cmp byte [rdi + rcx], byte [rbx + rcx] ; Compare characters
    jne .not_found         ; If not equal, the string doesn't end with '.txt'
    inc rcx               ; Move to the next character
    jmp .next_char

.not_found:
    xor rax, rax           ; Return 0 in rax (ZF will be clear)
    ret

.found:
    mov rax, 1             ; Return 1 in rax (ZF will be set)
    ret

