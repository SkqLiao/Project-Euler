if __name__ == '__main__':
	l = 1
	r = 1
	cur = 2
	while l < 10**999:
		tmp = l
		l = l + r
		r = tmp
		cur = cur + 1
	print(cur)