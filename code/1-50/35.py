from sympy import isprime

if __name__ == '__main__':
	ans = 1
	for i in range(2, 10 ** 6):
		if any(int(j) % 2 == 0 for j in str(i)): continue
		cur = str(i)[1:] + str(i)[0]
		flag = isprime(i)
		while cur != str(i) and flag:
			flag &= isprime(int(cur))
			cur = str(cur)[1:] + str(cur)[0]
		ans += flag
	print(ans)