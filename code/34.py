import math


if __name__ == '__main__':
	total = 0
	for i in range(10, math.factorial(9) * 7):
		if i == sum(math.factorial(int(i)) for i in str(i)):
			total += i
	print(total)