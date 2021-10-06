import os
from pwn import *
import sys


payload = ""

payload += "A" * 90


sys.stdout.write(payload)

