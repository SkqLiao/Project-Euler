if __name__ == '__main__':
	d, d2 = {}, {}
	for i in range(10000):
		sf = ''.join(sorted(list(str(i * i * i))))
		if not sf in d:
			d[sf] = i * i * i
			d2[sf] = 1
		else:
			d2[sf] += 1
			if d2[sf] == 5:
				print(d[sf])
				break