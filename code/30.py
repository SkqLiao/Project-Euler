if __name__ == '__main__':
	total = 0
	for i in range(10, 6 * 9 ** 5 + 1):
		cur = sum(int(j) ** 5 for j in str(i))
		if cur == i: total = total + i
	print(total)