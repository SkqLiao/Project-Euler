if __name__ == '__main__':
	f = [10 ** i for i in range(0, 7)]
	s = '0'
	cur = 1
	while len(s) <= f[6]:
		s += str(cur)
		cur += 1
	ans = 1
	for i in range(0, 7):
		ans = ans * int(s[f[i]])
	print(ans)