def check(x):
    f = [x * i for i in range(1, 7)]
    ori = list(str(x))
    ori.sort()
    for i in range(0, 6):
        cur = list(str(f[i]))
        cur.sort()
        if ori != cur:
            return False
    return True


if __name__ == '__main__':
    i = 0
    while True:
        i += 1
        if check(i):
            print(i)
            break
