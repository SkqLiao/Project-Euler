from itertools import *

def check(x):
	if x == 1: return False
	for i in range(2, int(x ** 0.5) + 1):
		if x % i == 0: return False
	return True

if __name__ == '__main__':
	ans = 0
	f = [i for i in range(1, 8)]
	for i in permutations(f):
		if check(int(''.join('%s'%j for j in i))): ans = int(''.join('%s'%j for j in i))
	print(ans)