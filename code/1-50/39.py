if __name__ == '__main__':
	mx = 0
	ans = 0
	for i in range(3, 1001):
		total = 0
		for a in range(1, i):
			for b in range(a, i):
				c = i - a - b
				if c < b: break
				if c ** 2 == a ** 2 + b ** 2: 
					total += 1
					break
		if total > mx: 
			mx = total
			ans = i
	print(ans) 