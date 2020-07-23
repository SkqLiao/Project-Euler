if __name__ == '__main__':
	up = 3
	down = 2
	cnt = 0
	for i in range(2, 1001):
		ndown = down + up
		nup = 2 * down + up
		if len(str(nup)) > len(str(ndown)): cnt += 1
		down = ndown
		up = nup
	print(cnt)