def two(x):
	f = []
	while x > 0:
		f.append(x % 2)
		x //= 2
	return ''.join('%s'%i for i in f)

if __name__ == '__main__':
	ans = 0
	for i in range(1, 10 ** 6 + 1):
		ii = two(i)
		if i % 2 == 1 and str(i) == str(i)[::-1] and ii == ii[::-1]:
			ans += i
			print(i)
	print(ans)