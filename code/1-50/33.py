import math

if __name__ == '__main__':
	up = 1
	down = 1
	for i in range(10, 100):
		for j in range(i + 1, 100):
			if i % 10 == j // 10:
				if i * (j % 10) == j * (i // 10): 
					up *= i
					down *= j
	print(down // math.gcd(up, down))