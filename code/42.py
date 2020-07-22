if __name__ == '__main__':
	s = set()
	for i in range(1, 100):
		s.add(i * (i + 1) / 2)
	with open('p042_words.txt') as f:
		names = f.read().split('","')
	names[0] = names[0][1:]
	names[-1] = names[-1][:-1]
	num = 0
	for name in names:
		x = sum(ord(i) - ord('A') + 1 for i in name)
		num += x in s
	print(num)