import queue

if __name__ == '__main__':
	f = [i * (3 * i - 1) // 2 for i in range(0, 1000001)]
	s = set(f)
	for i in range(1, 1000000):
		for j in range(1, 1000000):
			if f[i] + f[j] in s and f[i] + 2 * f[j] in s:
				print(f[i], f[j], f[i] + f[j])
				exit(0)
			elif f[i] + f[j] < f[j + 1]: break
			elif j == 999999:
				print(str(i) + "fuck")
				exit(0) 