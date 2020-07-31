if __name__ == '__main__':
	total = 1
	f = [3, 5, 7, 9]
	add = [2, 4, 6, 8]
	for cur in range(3, 1002, 2):
		for i in range(0, 4):
			add[i] += 8
			f[i] += add[i]
			total += f[i]
	print(total)