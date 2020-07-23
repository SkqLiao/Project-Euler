if __name__ == '__main__':
	cnt = 0
	for i in range(1, 10000):
		x = i
		flag = 1
		for j in range(0, 50):
			x = int(str(x)[::-1]) + x
			if str(x) == str(x)[::-1]:
				flag = 0
				break
		cnt += flag
	print(cnt)