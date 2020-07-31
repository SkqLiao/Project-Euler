from sympy import primerange

x = 600851475143

if __name__ == '__main__':
	primes = list(primerange(2, int(x ** 0.5) + 1))
	for p in primes[::-1]:
		if x % p == 0:
			print(p)
			break