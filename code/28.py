import numpy

def cal(x):
	dx = [-1, 0, 1, 0]
	dy = [0, 1, 0, -1]
	F = numpy.zeros((x, x))
	cx = x // 2
	cy = x // 2
	cur = 2
	total = 0
	cnt = 1
	d = 1
	while total < x ** 2:
		total = total + 1
		F[cx][cy] = total
		cx = cx + dx[d]
		cy = cy + dy[d]
		cnt = cnt + 1
		if cnt == cur:
			if d % 2 == 0: cur = cur + 1
			cnt = 1
			d = (d + 1) % 4
	total = -1
	for i in range(0, x):
		total = total + F[i][i] + F[i][x - i - 1]
	return total

if __name__ == '__main__':	
	print(cal(1001))