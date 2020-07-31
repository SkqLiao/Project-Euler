from sympy import isprime, primerange
import networkx
from networkx.algorithms.clique import find_cliques

N = 10000

def is_pair(x, y):
	return isprime(int(str(x) + str(y))) and isprime(int(str(y) + str(x)))

if __name__ == '__main__':
	G = networkx.Graph()
	primes = list(primerange(3, N))
	for i in range(0, len(primes)):
		for j in range(i + 1, len(primes)):
			if is_pair(primes[i], primes[j]):
				G.add_edge(primes[i], primes[j])
	ans = [clique for clique in find_cliques(G) if len(clique) == 5]
	print(min(map(sum, ans)))