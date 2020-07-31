from sympy import isprime

if __name__ == '__main__':
	cnt, ans, cur = 0, 0, 10
	while cnt < 11:
		s = str(cur)
		if cur > 99 and any(int(i) % 2 == 0 for i in s): 
			cur += 1
			continue
		flag = 1
		while len(s) and flag:
			flag &= isprime(int(s))
			s = s[1:]
		s = str(cur)
		while len(s) and flag:
			flag &= isprime(int(s))
			s = s[:-1]
		if flag:
			cnt += 1
			ans += cur
			print(cur)
		cur += 1
	print(ans)