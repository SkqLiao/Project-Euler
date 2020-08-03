if __name__ == '__main__':
	f = [2]
	for i in range(33):
		f += [1, 2 * i + 2, 1]
	up, down = 1, 1
	for i in range(len(f) - 2, -1, -1):
		newup = up + down * f[i]
		up = down
		down = newup
	print(sum(map(int, list(str(down)))))