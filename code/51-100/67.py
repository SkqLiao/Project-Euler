import numpy

if __name__ == '__main__':
    F = [[] for i in range(105)]
    G = numpy.zeros([105, 105])
    cur = 1
    with open('p067_triangle.txt', 'r') as f:
        line = f.readline()
        while line:
            F[cur] = [0] +list(map(int, line.split(' ')))
            line = f.readline()
            cur += 1
    for i in range(1, 101):
        for j in range(1, i + 1):
            G[i][j] = max(G[i - 1][j], G[i - 1][j - 1]) + F[i][j]
    print(max(G[100]))