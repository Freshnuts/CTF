<html><head><title>Linux/ARM - ifconfig eth0 and Assign Address</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Title: arm-ifconfig
 * Brief: Bring up eth0 and assign it the address 192.168.0.2
 * Author: Daniel Godas-Lopez &lt;gmail account dgodas&gt;
 */
 
    /*
      soc_des = socket(AF_INET, SOCK_DGRAM, IPPROTO_IP);
     */
 
    mov %r0, $2     /* AF_INET */
    mov %r1, $2     /* SOCK_DGRAM */
    mov %r2, $0     /* IPPRTOTO_IP */
    push {%r0, %r1, %r2}
    mov %r0, $1     /* socket */
    mov %r1, %sp
    svc 0x00900066
    add %sp, %sp, $12
 
    mov %r6, %r0        /* r6 = soc_des */
 
    /*
      ioctl(soc_des, SIOCSIFADDR, &amp;req);
     */
 
.if 0 /* r0 == r6 already */
    mov %r0, %r6        /* soc_des */
.endif
 
    sub %r1, %r1, %r1
    sub %r2, %r2, %r2
    push { %r1, %r2 }
    mov %r2, $2     /* AF_INET */
    mov %r3, $0x2000000
    add %r3, %r3, $0xa800
    add %r3, $0xc0      /* addr = 192.168.0.2 */
    push { %r2, %r3 }
    sub %r2, %r2, %r2
    sub %r3, %r3, %r3
    push { %r1, %r2, %r3 }
    mov %r3, $0x7400
    add %r3, $0x0065
    mov %r4, $0x3000
    add %r4, $0x0068
    add %r3, %r4, lsl $16   /* &quot;eth0&quot; */
    push { %r3 }
    mov %r2, %sp        /* struct __kernel_ifreq */
    add %sp, $32
 
    mov %r1, $0x8900
    add %r1, %r1, $0x16 /* SIOCSIFADDR */
    svc 0x00900036
 
    /*
      ioctl(soc_des, SIOCGIFFLAGS, &amp;req);
     */
 
    mov %r0, %r6        /* soc_des */
 
    mov %r1, $0x8900
    add %r1, %r1, $0x13 /* SIOCGIFFLAGS */
    svc 0x00900036
 
    ldr %r3, [%r2, $16]
    orr %r3, %r3, $1
    str %r3, [%r2, $16] /* ifr_flags |= IFF_UP */
 
    /*
      ioctl(soc_des, SIOCSIFFLAGS, &amp;req);
     */
 
    mov %r0, %r6        /* soc_des */
 
    mov %r1, $0x8900
    add %r1, %r1, $0x14 /* SIOCSIFFLAGS */
    svc 0x00900036

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
