
def pow(x, t, m):
	res = 1
	while t > 0:
		if t % 2 == 1: res = res * x % m
		x = x * x % m
		t = t // 2
	return res

def check(x):
	P = [31, 73]
	if x < 2 or (x % 6 != 1 and x % 6 != 5): return False
	s = x - 1
	while s % 2 == 0: s = s // 2
	for i in range(0, 2):
		if x == P[i]: return True
		t = s
		m = pow(P[i], s, x)
		while t != x - 1 and m != 1 and m != x - 1:
			m = m * m % x
			t = t * 2
		if t % 2 == 0 and m != x - 1: return False
	return True

def isPrime(x):
	if x < 2 or (x % 6 != 1 and x % 6 != 5): return False
	r = int(x ** 0.5)
	for i in range(2, r + 1):
		if x % i == 0: return False
	return True


def get(a, b):
	for i in range(0, abs(b)):
		if not isPrime(abs(i * i + a * i + b)):
			return i - 1
	return -1

if __name__ == '__main__':
	ans = 0
	mx = 0
	for a in range(-999, 1000):
		for b in range(-999, 1000):
			l = get(a, b)
			if l > mx:
				mx = l
				ans = a * b
	print(ans)