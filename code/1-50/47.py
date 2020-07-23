f = []
g = []

def Euler(n):
	isnPri = [0] * n
	for i in range(2, n):
		if not isnPri[i]:
			f.append(i)
		for j in f:
			x = i * j
			if x >= n: break
			isnPri[x] = 1
			if i % j == 0: break

def divide(x):
	cur = 0
	num = 0
	while True:
		if x % f[cur] == 0:
			x //= f[cur]
			return (x % f[cur] != 0) + g[x]
		cur += 1
	return -1

if __name__ == '__main__':
	R = 200000 + 1
	g = [0] * R
	Euler(R)
	for i in range(4, R):
		g[i] = divide(i)
		if g[i] == 4 and g[i - 1] == 4 and g[i - 2] == 4 and g[i - 3] == 4:
			print(i - 3)
			exit(0)