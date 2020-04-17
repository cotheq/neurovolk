from itertools import groupby
import re
import random
i = 0
a = []
with open("samples.big.fuck", "r", encoding="utf-8") as f:
    for line in f:
        a.append(line.rstrip("\n"))
        i += 1
        if i % 10000 == 0:
            print(i)
a = "\n".join(a)
a = a.split(sep="^")                 
print(len(a))

def addslashes(s):
    l = ["\\", '"', "'", "\0", ]
    for i in l:
        if i in s:
            s = s.replace(i, '\\'+i)
    return s

def appendtext(fn, text):
    try:
        f = open(fn, 'a', encoding="utf-8")
        f.write(text)
        f.close()
    except Exception:
        f.close()
        print("trying agaain...")
        appendtext(text)

query_start = "INSERT INTO citatas(text) VALUES"
query_end = ";\n"

i = 0
temp = []
for s in a:
    i += 1
    temp.append("('" + addslashes(s) + "')")
    if i % 200 == 0:
        appendtext("samples.sql", query_start + ",".join(temp) + query_end)
        temp = []
    if i % 10000 == 0:
        print(i)
        
appendtext("samples.sql", query_start + ",".join(temp) + query_end)

        
