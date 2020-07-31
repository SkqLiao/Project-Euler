if __name__ == '__main__':
	ans = '000000000'
	for i in range(1, 10 ** 4):
		cur = 2
		s = str(i)
		while len(s) < 9:
			s += str(cur * i)
			cur += 1
		if len(s) == 9 and set(s) == set(str(123456789)):
			ans = max(ans, s)
	print(ans)
