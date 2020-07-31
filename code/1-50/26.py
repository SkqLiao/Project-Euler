def get(x):
	print(x)
	cur, tms = 10, 1
	while cur % x != 1:
		if cur % x == 0: return 0
		cur = cur * 10 % x
		tms = tms + 1
	return tms

if __name__ == '__main__':
	mx = 1
	ans = 0
	for i in range(2, 1000):
		cur = get(i)
		if mx <= cur:
			mx = cur
			ans = i
	print(ans)