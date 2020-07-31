from sympy import isprime

def get(a, b):
	for i in range(0, abs(b)):
		if not isprime(abs(i * i + a * i + b)):
			return i - 1
	return -1

if __name__ == '__main__':
	ans, mx = 0, 0
	for a in range(-999, 1000):
		for b in range(-999, 1000):
			l = get(a, b)
			if l > mx:
				mx = l
				ans = a * b
	print(ans)