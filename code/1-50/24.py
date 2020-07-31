from math import factorial

if __name__ == '__main__':
	s = ''
	n = int(10 ** 6) - 1
	for i in range(9, -1, -1):
		s += str(n // factorial(i))
		n = n % factorial(i)
	f = list(i for i in range(0, 10))
	g = [0] * 10
	res = ''
	for i in map(int, s):
		cnt = 0
		for j in range(0, 10):
			if not g[j]: cnt += 1
			if cnt == i + 1:
				res += str(j)
				g[j] = 1
				break
	print(res)