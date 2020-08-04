from itertools import permutations

ans = []

def check(f):
	g = [0] * 5
	s = set(f)
	total = 11 + sum(f) // 5
	for i in range(5):
		g[i] = total - f[i] - f[(i + 1) % 5]
		if g[i] in s or not 1 <= g[i] <= 10: return False
		s.add(g[i])
	cur = 0
	for i in range(5):
		if g[i] < g[cur]: cur = i
	start = cur
	tans = ""
	while (cur != start or len(tans) == 0):
		tans += str(g[cur]) + str(f[cur]) + str(f[(cur + 1) % 5])
		cur = (cur + 1) % 5
	ans.append(tans)

f = []

def divide(left, cur, ff):
	if len(ff) == 5:
		if left == 0: 
			f.append(ff[:])
		return 
	for i in range(cur, 10):
		if left >= i:
			ff.append(i)
			divide(left - i, i + 1, ff)
			ff.pop()

if __name__ == '__main__':
	for i in range(3, 8):
		f.clear()
		divide(i * 5, 1, [])
		for ff in f:
			for fff in permutations(ff):
				check(fff)
	print(max(ans))