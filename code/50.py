N = 10 ** 6
f = []
pre = [0]
isnPri = [0] * N

def Euler(n):
	for i in range(2, n):
		if not isnPri[i]:
			f.append(i)
			pre.append(pre[-1] + i)
		for j in f:
			x = i * j
			if x >= n: break
			isnPri[x] = 1
			if i % j == 0: break

def lower_bound(f, x):
	l = 0
	r = len(f) - 1
	while l < r:
		m = (l + r) // 2
		if f[m] < x:
			l = m + 1
		else: r = m
	return r	

if __name__ == '__main__':
	Euler(N)
	mx = 0
	ans = 0
	r = lower_bound(pre, N)
	for i in range(0, r):
		for j in range(0, i):
			if not isnPri[pre[i] - pre[j]]:
				if mx < i - j:
					mx = i - j
					ans = pre[i] - pre[j]
	print(ans)
