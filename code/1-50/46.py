f = []

def divide(x):
	for i in f:
		y = (x - i) // 2
		if int(y ** 0.5) ** 2 == y:
			return True
	return False

def check(x):
	if x == 1: return False
	for i in range(2, int(x ** 0.5) + 1):
		if x % i == 0: return False
	return True

if __name__ == '__main__':
	for i in range(3, 10000, 2):
		if not check(i):
			if not divide(i):
				print(i)
				exit(0)
		else: f.append(i)