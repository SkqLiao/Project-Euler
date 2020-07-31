from collections import Counter

if __name__ == '__main__':
	with open('p059_cipher.txt', 'r') as f:
		cipher = list(map(int, f.read().split(',')))
	space_ascii = ord(' ')
	key = [Counter(cipher[i::3]).most_common(1)[0][0] ^ space_ascii for i in range(3)]
	cycles = len(cipher) // 3
	res = sum([x ^ y for x, y in zip(cipher, key * cycles)])
	print(res)