import numpy as np

if __name__ == '__main__':
	F = np.zeros((201, 8))
	P = [1, 2, 5, 10, 20, 50, 100, 200]
	F[1][0] = F[2][1] = F[5][2] = F[10][3] = F[20][4] = F[50][5] = F[100][6] = F[200][7] = 1
	for i in range(2, 201):
		for j in range(0, 8):
			if i > P[j]: F[i][j] += sum(F[i - P[j]][k] for k in range(0, j + 1))
	print(sum(F[10][i] for i in range(0, 8)))