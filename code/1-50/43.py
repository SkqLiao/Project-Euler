from itertools import permutations

if __name__ == '__main__':
	total = 0
	f = [i for i in range(0, 10)]
	p = [2, 3, 5, 7, 11, 13, 17]
	for i in permutations(f):
		if i[0] == 0: continue
		flag = 1
		for j in range(1, 8):
			flag &= (i[j] * 100 + i[j + 1] * 10 + i[j + 2]) % p[j - 1] == 0
		if flag == 1: total += int(''.join('%s'%k for k in i))
	print(total)