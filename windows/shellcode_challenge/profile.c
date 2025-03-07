#include <windows.h>
#include <userenv.h>
#include <stdio.h>

int main() {
    HANDLE hToken = NULL;                // Handle to the process token
    char profileDir[MAX_PATH];           // Buffer to store the profile directory
    DWORD dirSize = MAX_PATH;            // Size of the buffer

    // Step 1: Open the process token
    if (!OpenProcessToken(GetCurrentProcess(), TOKEN_QUERY, &hToken)) {
        printf("Failed to open process token. Error: %lu\n", GetLastError());
        return 1;
    }

    // Step 2: Call GetUserProfileDirectoryA
    if (GetUserProfileDirectoryA(hToken, profileDir, &dirSize)) {
        printf("User Profile Directory: %s\n", profileDir);
    } else {
        printf("Failed to get user profile directory. Error: %lu\n", GetLastError());
    }

    // Step 3: Clean up
    CloseHandle(hToken);

    return 0;
}