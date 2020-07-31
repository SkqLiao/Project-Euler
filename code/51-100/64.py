def cal(x):
	r = int(x ** 0.5)
	if r * r == x: return False
	ori_up, up = 1, 1
	ori_down, down = -r, -r
	tms = 0
	while True:
		tms += 1
		tmp_down = (x - down * down) // up
		p = int((x ** 0.5 - down) // tmp_down)
		down = -down - tmp_down * p
		up = tmp_down
		if up == ori_up and down == ori_down:
			return tms % 2

if __name__ == '__main__':
	print(sum(cal(i) for i in range(2, 10001)))