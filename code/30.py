
if __name__ == '__main__':
	total = 0
	for i in range(10, 6 * 9 ** 5 + 1):
		s = str(i)
		cur = 0
		for j in s:
			cur += int(j) ** 5
		if cur == i: total = total + i
	print(total)