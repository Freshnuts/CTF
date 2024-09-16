import sys

def hex_to_ascii(hex_str):
    # Convert hex string to bytes
    byte_data = bytes.fromhex(hex_str)
    # Convert bytes to ASCII string
    ascii_str = byte_data.decode('ascii', errors='replace')
    return ascii_str

# Example hexadecimal string (replace with your own)
hex_string = '68732f6e69622f'

# Convert to ASCII
ascii_output = hex_to_ascii(hex_string)

# Print the result
print(ascii_output)

