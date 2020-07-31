from sympy import primerange

def Euler(n):
	prime = []
	isnPri = [0] * n
	for i in range(2, n):
		if not isnPri[i]:
			prime.append(i)
		for j in prime:
			x = i * j
			if x >= n: break
			isnPri[x] = 1
			if i % j == 0: break
	return prime

if __name__ == '__main__':
	print(sum(Euler(2 * int(10 ** 6))))
	#print(sum(list(primerange(2, 2 * int(10 ** 6)))))