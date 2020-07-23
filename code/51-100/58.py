N = 10 ** 5
prime = []
isnPri = [0] * N

def Euler(n):
	for i in range(2, n):
		if not isnPri[i]:
			prime.append(i)
		for j in prime:
			x = i * j
			if x >= n: break
			isnPri[x] = 1
			if i % j == 0: break

def check(x):
	for i in prime:
		if i > x ** 0.5: return True
		if x % i == 0: return False

if __name__ == '__main__':
	Euler(N)
	cur = 3
	total = 3
	f = [3, 5, 7, 9]
	add = [2, 4, 6, 8]
	while True:
		for i in range(0, 4):
			add[i] += 8
			f[i] += add[i]
			total += check(f[i])
		cur += 2
		if total * 10 <= cur * 2 - 1:
			print(cur)
			break