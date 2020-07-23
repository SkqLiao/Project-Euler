if __name__ == '__main__':
	mx = 0
	for a in range(1, 100):
		for b in range(1, 100):
			cur = sum(ord(i) - ord('0') for i in str(a ** b))
			if cur > mx: mx = cur
	print(mx)