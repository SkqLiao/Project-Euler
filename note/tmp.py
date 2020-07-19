def Solve(n):
    r = int(n ** 0.5)
    V = [n // i for i in range(1, r + 1)]
    V += list(range(V[-1] - 1, 0, -1))
    S = {i : i * (i + 1) // 2 - 1 for i in V}
    tms = 0
    for p in range(2, r + 1):
        if S[p] != S[p - 1]:
            sp = S[p - 1]
            p2 = p * p
            for v in V:
                if v < p2: break
                S[v] -= p * (S[v // p] - sp)
    return S[n]

if __name__ == '__main__':
    print(Solve(int(input())) % 998244353)