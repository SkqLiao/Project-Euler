def Euler(n):
	prime = []
	isnPri = [0] * n
	for i in range(2, n):
		if not isnPri[i]:
			prime.append(i)
			if len(prime) == 10001: return i
		for j in prime:
			x = i * j
			if x >= n: break
			isnPri[x] = 1
			if i % j == 0: break

if __name__ == '__main__':
	print(Euler(int(10 ** 6)))