def get(x):
	cur = 10
	tms = 1
	while True:
		if tms == x or cur % x == 0: return 0
		if cur % x == 1: return tms
		cur = cur * 10 % x
		tms = tms + 1

if __name__ == '__main__':
	mx = 1
	ans = 0
	for i in range(2, 1000):
		cur = get(i)
		if mx <= cur:
			mx = cur
			ans = i
	print(ans)