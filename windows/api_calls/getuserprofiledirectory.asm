; Assemble with NASM and link with a 32-bit linker, e.g., GCC or GoLink
; nasm -f win32 getuserprofile.asm -o getuserprofile.obj
; golink /entry:start getuserprofile.obj kernel32.dll userenv.dll advapi32.dll msvcrt.dll

section .data
    hToken dd 0                            ; Handle to process token
    profileDir db 260 dup(0)               ; Buffer to store the profile directory
    dirSize dd 260                         ; Size of the buffer
    successMsg db "User Profile Directory: %s", 0 ; Format string for printf
    errorMsg db "Error occurred", 0        ; Error message string

section .bss
    ; Empty section for uninitialized variables if needed

section .text
    extern GetUserProfileDirectoryA        ; Import GetUserProfileDirectoryA
    extern OpenProcessToken                ; Import OpenProcessToken
    extern CloseHandle                     ; Import CloseHandle
    extern printf                          ; Import printf
    extern ExitProcess                     ; Import ExitProcess

global start                               ; Entry point for the program

start:
    ; Step 1: Open the process token
    push dword [hToken]                    ; Address of hToken
    push dword 0x8                         ; TOKEN_QUERY (access flag)
    push dword 0                           ; Current process handle (0 = current process)
    call OpenProcessToken                  ; Call OpenProcessToken
    test eax, eax                          ; Check if the function succeeded
    jz error                               ; Jump to error if eax == 0

    ; Step 2: Call GetUserProfileDirectoryA
    push dword [dirSize]                   ; Pointer to buffer size
    push dword profileDir                  ; Pointer to profileDir buffer
    push dword [hToken]                    ; Process token handle
    call GetUserProfileDirectoryA          ; Call GetUserProfileDirectoryA
    test eax, eax                          ; Check if the function succeeded
    jz error                               ; Jump to error if eax == 0

    ; Step 3: Print the result
    push dword profileDir                  ; User profile directory
    push dword successMsg                  ; Format string
    call printf                            ; Call printf
    add esp, 8                             ; Clean up the stack (2 arguments * 4 bytes)

    ; Step 4: Clean up and exit
    push dword [hToken]                    ; Push handle to close
    call CloseHandle                       ; Call CloseHandle
    jmp done                               ; Jump to exit

error:
    ; Print the error message
    push dword errorMsg                    ; Error message
    call printf                            ; Call printf
    add esp, 4                             ; Clean up the stack (1 argument)

done:
    ; Exit the program
    push dword 0                           ; Exit code
    call ExitProcess                       ; Call ExitProcess

