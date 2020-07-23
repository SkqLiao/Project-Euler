def check(x):
	for i in range(2, int(x ** 0.5) + 1):
		if x % i == 0: return False
	return True

if __name__ == '__main__':
	ans = 0
	for i in range(2, 10 ** 6):
		cur = str(i)[1:] + str(i)[0]
		flag = check(i)
		while cur != str(i) and flag:
			flag &= check(int(cur))
			cur = str(cur)[1:] + str(cur)[0]
		ans += flag
	print(ans)