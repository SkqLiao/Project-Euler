def two(x):
	f = []
	while x > 0:
		f.append(x % 2)
		x //= 2
	return ''.join('%s'%i for i in f)

if __name__ == '__main__':
	ans = 25
	for i in range(1, 1000):
		ii = int(str(i) + str(i)[::-1])
		iii = two(ii)
		if len(str(ii)) == len(str(i)) * 2 and iii == iii[::-1]:
			ans += ii
	for i in range(1, 100):
		for j in range(10):
			ii = int(str(i) + str(j) + str(i)[::-1])
			iii = two(ii)
			if len(str(ii)) == 1 + len(str(i)) * 2 and iii == iii[::-1]:
				ans += ii
	print(ans)