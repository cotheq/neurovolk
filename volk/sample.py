import argparse
import json
import os
import random
from datetime import datetime
import numpy as np
from keras.models import Sequential, load_model
from keras.layers import LSTM, Dropout, TimeDistributed, Dense, Activation, Embedding
from model import build_model, load_weights

os.environ["CUDA_DEVICE_ORDER"] = "PCI_BUS_ID" 
os.environ["CUDA_VISIBLE_DEVICES"] = ""

DATA_DIR = './data'
MODEL_DIR = './model'
SAMPLES_DIR = './samples'

def build_sample_model(vocab_size):
    model = Sequential()
    model.add(Embedding(vocab_size, 512, batch_input_shape=(1, 1)))
    for i in range(3):
        model.add(LSTM(256, return_sequences=(i != 2), stateful=True))
        model.add(Dropout(0.2))

    model.add(Dense(vocab_size))
    model.add(Activation('softmax'))
    return model

def sample(epoch, header, num_chars):
    with open(os.path.join(MODEL_DIR, 'char_to_idx.json'), 'r') as f:
        char_to_idx = json.load(f)
    idx_to_char = { i: ch for (ch, i) in list(char_to_idx.items()) }
    vocab_size = len(char_to_idx)

    model = build_sample_model(vocab_size)
    load_weights(epoch, model)
    model.save(os.path.join(MODEL_DIR, 'model.{}.h5'.format(epoch)))

    sampled = [char_to_idx[c] for c in header]
    for c in header[:-1]:
        batch = np.zeros((1, 1))
        batch[0, 0] = char_to_idx[c]
        model.predict_on_batch(batch)

    for i in range(num_chars):
        batch = np.zeros((1, 1))
        if sampled:
            batch[0, 0] = sampled[-1]
        else:
            batch[0, 0] = np.random.randint(vocab_size)
        result = model.predict_on_batch(batch).ravel()
        sample = np.random.choice(list(range(vocab_size)), p=result)
        sampled.append(sample)

    return ''.join(idx_to_char[c] for c in sampled)

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Sample some text from the trained model.')
    parser.add_argument('epoch', type=int, help='epoch checkpoint to sample from')
    parser.add_argument('--seed', default='', help='initial seed for the generated text')
    parser.add_argument('--len', type=int, default=1000, help='number of characters to sample (default 512)')
    parser.add_argument('--one', action="store_true", help='get one random phrase or write multiple ones to file')
    args = parser.parse_args()
    time = datetime.now().strftime("%Y-%m-%d-%H-%M-%S")
    
    if args.one:
        smp = sample(args.epoch, "^" + args.seed, 200)
        a = smp.split("^")
        #index = random.randint(1, len(a)-2) if args.seed == "" else 1
        #print("\n\n" + a[index])
        print(a[1]);
    else:
        smp = sample(args.epoch, "^" + args.seed, args.len)
        if not os.path.exists(SAMPLES_DIR):
            os.makedirs(SAMPLES_DIR)
        f = open(os.path.join(SAMPLES_DIR, 'sample.' + str(args.epoch) + "." + time + '.txt'), 'w', encoding='utf-8')
        f.write(smp)
        f.close()
