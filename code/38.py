if __name__ == '__main__':
	ans = '000000000'
	for i in range(1, 10 ** 4):
		for j in range(1, 8):
			cur = j + 2
			s = str(i * j) + str(i * (j + 1))
			while len(s) < 9:
				s += str(cur * i)
				cur += 1
			if len(s) > 9: break
			else:
				f = list(s)
				f.sort()
				if ''.join(f) == '123456789':
					print(s)
					ans = max(ans, s)
	print(ans)
