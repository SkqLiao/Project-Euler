N = int(10 ** 7)
phi = [0] * N
prime = []

def check(x):
	return sorted(list(str(x))) == sorted(list(str(phi[x])))

def Euler(n):
	ans = 2
	for i in range(2, N):
		if not phi[i]:
			phi[i] = i - 1
			prime.append(i)
		if check(i) and i * phi[ans] < ans * phi[i]: ans = i
		for j in prime:
			tmp = i * j
			if tmp >= n: break
			if i % j == 0:
				phi[tmp] = j * phi[i]
				break
			phi[tmp] = phi[i] * (j - 1)
	print(ans)

if __name__ == '__main__':
	Euler(N)