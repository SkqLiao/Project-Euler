def divide(n):
	total = 1
	r = int(n ** 0.5)
	for i in range(2, r + 1):
		if n % i == 0:
			total = total + i
			if n // i != i: total = total + n // i
	return total


if __name__ == '__main__':
	V = []
	F = [0]*28123
	for i in range(2, 28123):
		if divide(i) > i:
			V.append(i)
			for j in V:
				if i + j < 28123:
					F[i + j] = 1
	total = 0
	for i in range(1, len(F)):
		if F[i] == 0:
			total = total + i
	print(total)
	