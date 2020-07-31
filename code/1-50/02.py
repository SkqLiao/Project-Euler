if __name__ == '__main__':
	f = [1, 2]
	while True:
		f.append(f[-1] + f[-2])
		if f[-1] > 4 * 10 ** 6: break
	print(sum(i for i in f if i % 2 == 0))