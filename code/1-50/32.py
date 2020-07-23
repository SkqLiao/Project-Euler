if __name__ == '__main__':
	s = set()
	for i in range(1, 10):
		for j in range(1000, 10000): 
			digit = list(str(i)) + list(str(j)) + list(str(i * j))
			digit.sort()
			if ''.join(digit) == '123456789':
				s.add(i * j)
	for i in range(10, 100):
		for j in range(100, 1000):
			digit = list(str(i)) + list(str(j)) + list(str(i * j))
			digit.sort()
			if ''.join(digit) == '123456789':
				s.add(i * j)
	print(sum(s))