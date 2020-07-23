from itertools import *

def check(x):
	if x == 1: return False
	for i in range(2, int(x ** 0.5) + 1):
		if x % i == 0: return False
	return True

def cal(f, l):
	g = [i * 10 + l for i in f]
	for i in g:
		if not check(i): return False
	print(g)
	return True

def get(i, j, k, l):
	f = [i, j, k]
	g = []
	s = set()
	for x in permutations(f):
		y = int(''.join('%s'%p for p in x))
		if y > 99:
			g.append(y)
			s.add(y)
	g.sort()
	for i in range(0, len(g)):
		for j in range(i + 1, len(g)):
			if 2 * g[j] - g[i] in s:
				cal([g[i], g[j], 2 * g[j] - g[i]], l)
	return True

if __name__ == '__main__':
	for l in range(1, 10, 2):
		for i in range(0, 10):
			for j in range(i + 1, 10):
				for k in range(j + 1, 10):
					get(i, j, k, l)