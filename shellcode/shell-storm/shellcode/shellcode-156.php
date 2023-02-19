<html><head><title>Windows - PEB!NtGlobalFlags shellcode - 14 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 PEB!NtGlobalFlags ( 14 BYTES )
 Author: Koshi
 Description: Uses PEB method to determine whether a debugger is
	      attached to the running proccess or not. No 9x. :(
 Length: 14 Bytes
 Registers Used: EAX,ESI,ESP
 Compiled: jpXV34dd3v09Fh

*/

/*

 00401000 &gt;   6A 70          PUSH 70
 00401002     58             POP EAX
 00401003     56             PUSH ESI
 00401004     333464         XOR ESI,DWORD PTR SS:[ESP]
 00401007     64:3376 30     XOR ESI,DWORD PTR FS:[ESI+30]
 0040100B     3946 68        CMP DWORD PTR DS:[ESI+68],EAX
			     JE DebuggerPresent ( If equal debugger attached )
*/

unsigned char Shellcode[] =
{&quot;\x6A\x70\x58\x56\x33\x34\x64&quot;
&quot;\x64\x33\x76\x30\x39\x46\x68&quot;};



int main( int argc, char *argv[] )
{
 printf( &quot;Shellcode is %u bytes.\n&quot;, sizeof(Shellcode)-1 );
 printf( Shellcode, sizeof(Shellcode) );
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
