if __name__ == '__main__':
	for i in range(1, 1000 // 3):
		for j in range(i, 1000):
			if i * i + j * j == (1000 - i - j) * (1000 - i - j):
				print(i * j * (1000 - i - j))
				exit(0)