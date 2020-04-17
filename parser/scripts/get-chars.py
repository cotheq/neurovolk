f = open("volk.cleaned.big.txt", "r", encoding="utf-8")
from collections import defaultdict
d = defaultdict(int)

for line in f:
    for w in line:
      d[w] += 1
print(len(d))
dictfile = open('volk.chars.pure.txt', 'w', encoding="utf-8")
dictfile.write(str(sorted(d, key=d.get, reverse=True)))
dictfile.close()
'''for w in sorted(d, key=d.get, reverse=True):
  
  #dictfile.write(w + " " + str(d[w]) + "^\n")
  dictfile.write(w)
dictfile.close()'''
