if __name__ == '__main__':
	x = sum(i ** i for i in range(1, 1001))
	print(x % int(10 ** 10))