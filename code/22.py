if __name__ == '__main__':
	with open('p022_names.txt') as file:
		s = file.read()
	names = s.split('","')
	names[0] = names[0][1:]
	names[-1] = names[-1][:-1]
	names.sort()
	total = 0
	cnt = 1
	for name in names:
		cur = 0
		for alpha in name:
			cur = cur + ord(alpha) - ord('A') + 1
		total = total + cur * cnt
		cnt = cnt + 1
	print(total)