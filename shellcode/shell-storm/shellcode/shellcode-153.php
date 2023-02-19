<html><head><title>Windows - IsDebuggerPresent ShellCode (NT/XP) - 39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Shellcode Length: 39 bytes  */
/* sets PEB-&gt;BeingDebugged to 0 */
/* IsDebuggerPresent()/BeingDebugged bypass */
/* by ex-pb @ screw_you@web.de */
/* greets: xgx and all i forgot */

#include &lt;stdio.h&gt;
#include &lt;windows.h&gt;

char ShellCode[] = &quot;\xEB&quot;
&quot;\x0F\x58\x80\x30\x95\x40\x81\x38\x68\x61\x63\x6B\x75\xF4\xEB\x05\xE8\xEC\xFF\xFF&quot;
&quot;\xFF\xF1\x34\xA5\x95\x95\x95\xAB\x53\xD5\x97\x95\x56\x68\x61\x63\x6B\xCD&quot;;

int main()
{
	printf(&quot;Shellcode length: %d\n&quot;, strlen(ShellCode));
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
