if __name__ == '__main__':
	f = [i * (i + 1) / 2 for i in range(1, 100000)]
	g = [i * (3 * i - 1) / 2 for i in range(1, 100000)]
	h = [i * (2 * i - 1) for i in range(1, 100001)]
	s = {i : 1 for i in f}
	for i in g:
		if i in s: 
			s[i] = s[i] + 1
	for i in range(0, 100000):
		if h[i] in s and s[h[i]] == 2:
			print(h[i])