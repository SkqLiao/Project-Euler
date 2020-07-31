if __name__ == '__main__':
	l, r, cur = 1, 1, 2
	while l < 10 ** 999:
		tmp = l
		l += r
		r = tmp
		cur += 1
	print(cur)