from sympy import isprime

N = 1000000

if __name__ == '__main__':
	ans = 1
	for i in range(2, N):
		if isprime(i):
			if ans * i >= N:
				print(ans)
				break
			ans *= i