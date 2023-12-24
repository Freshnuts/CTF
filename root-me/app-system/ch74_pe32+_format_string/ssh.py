from pwn import *

def connect_and_open_binary():
    # Define SSH connection parameters
    ssh_host = 'challenge05.root-me.org'
    ssh_port = 2225
    ssh_user = 'app-systeme-ch74'
    ssh_password = 'app-systeme-ch74'
    
    # Define binary file path on the remote server
    binary_path = '/challenge/app-systeme/ch74/ch74.exe'

    # Establish SSH connection
    s = ssh(host=ssh_host, port=ssh_port, user=ssh_user, password=ssh_password)

    try:
        # Example: Run 'cat' command to display the contents of the binary file
        result = s.run(f'{binary_path}')
        print(result.decode())

    except Exception as e:
        print(f"An error occurred: {e}")

    finally:
        # Close the SSH connection
        s.close()

if __name__ == "__main__":
    connect_and_open_binary()


