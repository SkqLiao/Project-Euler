N = 1000000
Square = {}

def solve(d):
	for i in range(1, N):
		x = 1 + d * i * i
		if x > N * N: break
		if x in Square: return Square[x]
	return N

if __name__ == '__main__':
	f = []
	Square = {i * i : i for i in range(N)}
	for d in range(2, 1000):
		r = int(d ** 0.5)
		if r * r == d: continue
		f.append(solve(d))
		print("%s:%s"%(d, f[-1]))
	print(max(f))