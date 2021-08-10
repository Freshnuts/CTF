import os
import sys
import time
from subprocess import PIPE, Popen


dic = "/usr/share/wordlists/fasttrack.txt"

for line in dic:
    print "check: %s" % line
