def check(x):
	if x == 1: return False
	for i in range(2, int(x ** 0.5) + 1):
		if x % i == 0: return False
	return True

if __name__ == '__main__':
	cnt = 0
	cur = 10
	ans = 0
	while cnt < 11: 
		s = str(cur)
		flag = 1
		while len(s) and flag:
			flag &= check(int(s))
			s = s[1:]
		s = str(cur)
		while len(s) and flag:
			flag &= check(int(s))
			s = s[:-1]
		if flag:
			cnt += 1
			ans += cur
		cur += 1
	print(ans)