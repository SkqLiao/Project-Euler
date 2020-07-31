from itertools import permutations
from sympy import isprime

if __name__ == '__main__':
	ans = 0
	f = [i for i in range(1, 8)]
	for i in permutations(f):
		if isprime(int(''.join('%s'%j for j in i))): ans = int(''.join('%s'%j for j in i))
	print(ans)