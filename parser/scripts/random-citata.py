import random
a = open("D:\\Downloads\\sample333.txt", encoding="utf-8").read().split("^")
print(a[random.randint(0, len(a)-1)])
