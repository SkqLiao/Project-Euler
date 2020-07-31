if __name__ == '__main__':
	s1 = sum(i for i in range(101))
	s2 = sum(i * i for i in range(101))
	print(s1 * s1 - s2)