if __name__ == '__main__':
	mx, ans = 0, 0
	for i in range(4, 1001, 2):
		total = 0
		for a in range(1, i // 3):
			for b in range(a, i):
				c = i - a - b
				if c < b: break
				if c * c == a * a + b * b: 
					total += 1
					break
		if total > mx: 
			mx = total
			ans = i
	print(ans) 