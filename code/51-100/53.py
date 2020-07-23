import math

if __name__ == '__main__':
	cnt = 0
	for i in range(1, 101):
		for j in range(0, i + 1):
			if math.factorial(i) // math.factorial(j) // math.factorial(i - j) > 10 ** 6:
				cnt += 1
	print(cnt)