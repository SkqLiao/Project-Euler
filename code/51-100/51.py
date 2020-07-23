from itertools import *

N = 10 ** 6
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
	if x < 56003: return
	xx = str(x)
	ff = [0] * (len(xx) - 1)
	while True:
		cnt = 0
		p = len(ff) - 1
		ff[-1] += 1
		while (ff[p] > 1):
			if p == 0: return
			ff[p - 1] += 1
			ff[p] -= 2
			p -= 1
		c = ''
		for j in range(0, len(ff)):
			if ff[j]: c += xx[j]
		if c != c[0] * len(c): continue
		for i in range(0, 10):
			if i == 0 and ff[0] == 1: continue
			cur = ''
			for j in range(0, len(ff)):
				if ff[j]: 
					cur += chr(i + ord('0'))
				else: cur += xx[j]
			cur += xx[-1]
			if not isnPri[int(cur)]: cnt += 1
		if cnt >= 8:
			print(x)
			exit(0)

if __name__ == '__main__':
	Euler(N)
	for i in prime:
		check(i)