import networkx as nx
from collections import namedtuple

G = nx.DiGraph()
d = {}
path = []

def dfs(x):
	if len(path) == 6:
		if path[-1].id % 100 == path[0].id // 100:
			print(sum(i.id for i in path))
			exit()
		return 
	d[x] = 1
	for y in G.neighbors(x):
		if not y in d and not any(y.type == i.type for i in path):
			path.append(y)
			dfs(y)
			path.pop()
	del d[x]

if __name__ == '__main__':
	Lists = [[] for i in range(6)]
	Lists[0] = [i * (i + 1) // 2 for i in range(200)]
	Lists[1] = [i * i for i in range(100)]
	Lists[2] = [i * (3 * i - 1) // 2 for i in range(100)]
	Lists[3] = [i * (2 * i - 1) for i in range(100)]
	Lists[4] = [i * (5 * i - 3) // 2 for i in range(100)]
	Lists[5] = [i * (3 * i - 2) for i in range(100)]
	Lst = [[] for i in range(100)]
	Fir = [[] for i in range(100)]
	Node = namedtuple('Node', ['id', 'type'])
	for i in range(6):
		Lists[i] = list(filter(lambda x: 1000 <= x < 10000, Lists[i]))
		for j in Lists[i]:
			Lst[j % 100].append(Node(j, i))
			Fir[j // 100].append(Node(j, i))
			G.add_node(Node(j, i))
	for i in range(10, 100):
		for j in Lst[i]:
			for k in Fir[i]:
				G.add_edge(j, k)
	for u in G.nodes:
		path.append(u)
		dfs(u)
		path.pop()