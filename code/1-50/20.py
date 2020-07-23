import math
if __name__ == '__main__':
	result = 0
	for i in str(math.factorial(100)):
		result = result + int(i)
	print(result)