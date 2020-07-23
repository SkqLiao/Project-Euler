import numpy as np

if __name__ == '__main__':
	F = np.zeros((201, 8))
	P = [1, 2, 5, 10, 20, 50, 100, 200]
	for i in range(0, 8):
		F[P[i]][i] = 1
	for i in range(2, 201):
		for j in range(0, 8):
			if i > P[j]: F[i][j] += sum(F[i - P[j]][k] for k in range(0, j + 1))
	print(sum(F[200][i] for i in range(0, 8)))