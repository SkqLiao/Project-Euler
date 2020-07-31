if __name__ == '__main__':
	ans, cur = 0, 1
	for i in range(100):
		st = int(cur ** (1 / (i + 1)))
		if cur ** (1 / (i + 1)) - int(cur ** (1 / (i + 1))) > 10**-5: st += 1
		ans += 10 - st
		cur *= 10
		if (st == 10): break 
	print(ans)