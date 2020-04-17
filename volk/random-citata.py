import random
from datetime import datetime
import os
from glob import glob

SAMPLES_DIR = './samples'

def get_files(pattern):
    files = list(glob(os.path.join(SAMPLES_DIR, pattern)))
    if not files:
        raise ValueError("No samples")
    return files

files = get_files("sample.*.*.txt")
max_epoch = max(int(f.split('.')[2]) for f in files)
files = get_files("sample." + str(max_epoch) + ".*.txt")
date_format = "%Y-%m-%d-%H-%M-%S"
max_time = max(int(datetime.strptime(f.split('.')[3], date_format).timestamp()) for f in files)

fn = os.path.join(SAMPLES_DIR, 'sample.' + str(max_epoch) + '.' + datetime.strftime(datetime.fromtimestamp(max_time), date_format) + '.txt')
a = open(fn, encoding="utf-8").read().split("^")
print(a[random.randint(0, len(a)-1)])
