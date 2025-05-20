import sys
import os

def ascii_to_little_endian_hex(ascii_str):
    # Convert each character to its hex representation
    hex_bytes = [format(ord(c), '02x') for c in ascii_str]

    # Reverse the byte order for little endian
    hex_bytes.reverse()

    # Join and prepend '0x'
    little_endian_hex = '0x' + ''.join(hex_bytes)
    return little_endian_hex



def little_endian_hex_to_ascii(hex_str):
    # Remove the "0x" prefix if present
    if hex_str.startswith("0x"):
        hex_str = hex_str[2:]
    
    # Ensure even number of characters
    if len(hex_str) % 2 != 0:
        raise ValueError("Hex string must have an even number of characters.")

    # Split into byte pairs
    bytes_list = [hex_str[i:i+2] for i in range(0, len(hex_str), 2)]

    # Reverse for little endian to big endian
    bytes_list.reverse()

    # Convert hex to ASCII
    ascii_str = ''.join([chr(int(b, 16)) for b in bytes_list])
    return ascii_str

def main():
    while True:

        print('''
        1. Ascii to Little Endian Hex
        2. Little Endian to Ascii
        3. Exit
        ''')

        answer = input()

        if answer == '1':
            ascii_string = input()
            hex_output = ascii_to_little_endian_hex(ascii_string)
            print(hex_output)  # Output: 0x44434241

        elif answer == '2':
            hex_string = input()
            ascii_output = little_endian_hex_to_ascii(hex_string)
            print(ascii_output)  # Output: Temp

        else:
            print("Exiting")
            break


main()
