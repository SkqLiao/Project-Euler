from sympy import factorint

def calFactors(x):
	if x % 2 == 0: x //= 2
	divs = factorint(x)
	num = 1
	for p in divs:
		num *= divs[p] + 1
	return num

if __name__ == '__main__':
	N = int(10 ** 5)
	for i in range(3, N):
		if calFactors(i) * calFactors(i - 1) >= 500:
			print(i * (i - 1) // 2)
			break