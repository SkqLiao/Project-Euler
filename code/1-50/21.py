from sympy import factorint

def calSum(x):
	divs = factorint(x)
	res = 1
	for p in divs:
		res *= (p ** (divs[p] + 1) - 1) // (p - 1)
	return res - x

if __name__ == '__main__':
	res = 0
	for i in range(1, 10000):
		x = calSum(i)
		if i != x and calSum(x) == i:
			res += i
	print(res)