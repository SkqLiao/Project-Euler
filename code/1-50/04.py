if __name__ == '__main__':
	res = []
	for i in range(100, 1000):
		for j in range(i, 1000):
			if str(i * j) == str(i * j)[::-1]:
				res.append(i * j)
	print(max(res))