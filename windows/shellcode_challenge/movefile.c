#include <windows.h>
#include <stdio.h>

int main() {
    // Define source and destination paths
    const char *sourceFile = "C:\\Users\\exploit\\Desktop\\ctf\\shellcode_challenge\\met.txt";  // Change this to the actual source path
    const char *destinationFile = "C:\\Users\\exploit\\met.txt";  // Change this as needed

    // Call MoveFileA to move the file
    if (MoveFileA(sourceFile, destinationFile)) {
        printf("File moved successfully from %s to %s\n", sourceFile, destinationFile);
    } else {
        printf("Failed to move file. Error: %lu\n", GetLastError());
    }

    return 0;
}

