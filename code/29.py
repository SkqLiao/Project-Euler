import numpy as np

def solve(a, b):
	F = []
	for i in range(2, a + 1):
		for j in range(2, b + 1):
			F.append(i ** j)
	newF = np.unique(F)
	return len(newF)

def F(a, b):
	return len(set(i ** j for i in range(2, a + 1) for j in range(2, b + 1)))

if __name__ == '__main__':
	#print(solve(100, 100))
	print(F(100, 100))