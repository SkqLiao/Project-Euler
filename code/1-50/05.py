from sympy import primerange
from math import log
from functools import reduce

N = 20

if __name__ == '__main__':
	primes = list(primerange(2, N))
	pp = [int(p ** int(log(N, p))) for p in primes]
	print(reduce(lambda x,y: x * y, pp))