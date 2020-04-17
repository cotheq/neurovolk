from itertools import groupby
import re
import random
fn = "D:\\volk\\samples\\sample.356.2019-12-18-14-39-35.txt"
f = open(fn, "r", encoding="utf-8").read()
a = f.split(sep="^")[:-1]
print(len(a))  
b = []
i = 0

rgs = [
    #"/😍|😔|❤|🙏|🔥|😊|😂|✌|👇|😌|😈|😉|🎧|🏻|🖤|💫|👌|☝|👍|✨|🌸|😏|😃|￼|😄|💪|🌚|😎|💕|😱|❄|💔|🌺|💋|😆|👏|🍃|📺|😜|🙌|😕|😘|🎄|💥|😢|😋|👊|🍂|☀|✋|😻|💞|😩|😇|✈|🥀|😒|🏼|🙈|😭|💭|💖|😳|👑|😐|😀|🚀|🕊|👼|🤘|💙|😑|👆|👪|😁|❗|🌲|🌹|✊|🌑|😹|🍁|☁|😴|🌿|🍫|😟|🌝|🙅|💰|🤣|😅|🎶|🎁|✔|💜|💎|😮|💐|😠|🔫|📱|🎅|🌴|🔝|🌊|🍓|🤗|📢|👈|💦|💣|😽|😚|👿|🐼|💝|🏡|🍷|💗|💑|🎈|😨|🔞|🙀|💃|🍑|⛄|🐈|🎀|😰|🔹|🌙|👀|🎤|🤤|🏊|😷|🍒|🌼|👰|🔱|✟|🍴|😓|🔪|🍰|⭐|💤|☆|🌷|🚶|😖|☘|💏|🏃|🎬|💓|►|👯|🖕|🆘|🌟|🌞|😝|☕|🍹|👉|😥|👋|🚘|♔|⚡|🔗|🙇|🏠|☜|☞|✝|👐|💴|💷|💳|📚|😫|🎂|🍉|😡|⛔|👩|👦|💻|✉|➕|➖|🐣|🎨|💌|🦁|🎳|🎙|🤢|🤷|♂|♻|😸|🐹|👸|🏆|⚽|👎|👵|🌌|👫|☻|🎥|🚗|💽|🏒|🥅|▷|▪|📞|👻|😯|🎚|🔰|🙃|⬛|💘|💶|🤔|🦋|🏾|🐉|😶|😧|🔊|🎉|😣|⤵|🏩|🐑|🎵|👽|🍼|👶|🤪|🍝|🍛|★|😛|🖇|😞ฺ|🌦|👠|✖|🖐|🌁|🦉|🎼|🤙|❣|🚫|🍏|🍐|☹/",
    #"/\d{1,}/",
    "￼"
    
]



for s in a:
    match = True

    if len(s) < 5:
        match = False
    
    for rg in rgs:
        if re.search(rg, s, flags=re.I):
            match = False
            break
    
    sss = s.split(",")
    if len(sss) > 3:
        match = False

    max_split_length = 0    
    for ss in sss:
        max_split_length = max(max_split_length, len(ss))
    if max_split_length > 38:
        match = False
    
    if match:
        b.append(s)

def appendtext(fn, text):
    try:
        f = open(fn, 'a', encoding="utf-8")
        f.write(text)
        f.close()
    except Exception:
        print("trying agaain...")
        appendtext(text)

c = list(set(b))
        
print(len(b))
print(len(c))

cc = 0
for s in b:
    appendtext(fn + ".min", "^" + s)
    cc += 1
    if cc % 1000 == 0:
        print(cc)

appendtext(fn + ".min", "^")
