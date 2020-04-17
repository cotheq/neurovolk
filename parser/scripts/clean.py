from itertools import groupby
import re
import random
f = open("volk.txt", "r", encoding="utf-8").read()
a = f.split(sep="^")
print(len(a))  
b = []
i = 0

rgs = [
    "\[.*\|.*]",
    "vk\.cc",
    "vk\.me",
    "Да \+\nНет -",
    "Mагазuн",
    "👇🏻",
    "✍",
    "ком{1,}енты",
    "Нaпишите \"ДA\"",
    "vk\.com\/",
    "(((с|С)вой)|((в|В)аш)) вариант",
    "http",
    "((п|П)одпи(шись|сался|сан))",
    "подпи",
    "в комм",
    "galaxy",
    "ссылка",
    "honor",
    "смартфон",
    "в комм",
    "заработай",
    "goo\.gl",
    "bit\.ly",
    "подборк",
    "репост",
    "\[club"
    "\[id"
]



for s in a:
    if len(s) >= 30 and len(s) <= 200:
        match = False
        for rg in rgs:
            match = match or re.search(rg, s, flags=re.I)    
        if not match:
            b.append(s)


from collections import defaultdict
d = defaultdict(int)
for w in b:
  d[w] += 1


def appendtext(fn, text):
    try:
        f = open(fn, 'a', encoding="utf-8")
        f.write(text)
        f.close()
    except Exception:
        print("trying agaain...")
        appendtext(text)
  
for w in sorted(d, key=d.get, reverse=True):
  appendtext('volk.super.dict.txt', w + " " + str(d[w]) + "^\n")

c = list(set(b))
        
print(len(b))
print(len(c))
out = c * 5 + b
print(len(out))
random.shuffle(b)
cc = 0
for s in out:
    appendtext("volk.super.cleaned.txt", "^" + s)
    cc += 1
    if cc % 20000 == 0:
        print(cc)
