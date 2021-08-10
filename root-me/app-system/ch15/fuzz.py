import time
import os
import sys

i = 0

ch15 = "| ./ch15"
for i in range(200):
    os.system("echo 'i'"+ch15)
    print "A" * i 
    i += 1
    

print "Final Number: %d", i
