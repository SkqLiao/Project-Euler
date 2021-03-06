from sympy import factorint

def calSum(x):
	divs = factorint(x)
	res = 1
	for p in divs:
		res *= (p ** (divs[p] + 1) - 1) // (p - 1)
	return res - x

if __name__ == '__main__':
	N = 28123
	F = set()
	res = 0
	for i in range(2, N):
		if calSum(i) > i: F.add(i)
		if not any((i - x in F) for x in F): res += i
	print(res)
	