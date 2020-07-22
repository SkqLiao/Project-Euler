import queue

if __name__ == '__main__':
	f = [i * (3 * i - 1) // 2 for i in range(0, 10000)]
	s = set()
	q = queue.PriorityQueue()
	for i in range(1, 10000):
		s.add(f[i])
		for j in range(i + 1, 10000):
			q.put([abs(f[i] - f[j]), i, j])
	while not q.empty():
		x = q.get()
		if x[0] in s and (f[x[1]] + f[x[2]]) in s:
			print(x)
			exit(0)