from itertools import groupby
import re
import random
f = open("volk.cleaned.big.txt", "r", encoding="utf-8").read()
a = f.split(sep="^")
print(len(a))  
random.shuffle(a)
cc = 0

def appendtext(fn, text):
    try:
        f = open(fn, 'a', encoding="utf-8")
        f.write(text)
        f.close()
    except Exception:
        f.close()
        print("trying agaain...")
        appendtext(text)

for s in a:
    appendtext("volk.shuffled.txt", "^" + s)
    cc += 1
    if cc % 20000 == 0:
        print(cc)
