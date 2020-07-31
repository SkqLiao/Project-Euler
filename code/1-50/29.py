def F(a, b):
	return len(set(i ** j for i in range(2, a + 1) for j in range(2, b + 1)))

if __name__ == '__main__':
	print(F(100, 100))