
s = {}

def getS(f):
	# Royal Flush: Ten, Jack, Queen, King, Ace, in same suit.
	p1 = []
	p2 = ''
	for i in f:
		p1.append(s[i[0]])
		p2 += i[-1]
	p1.sort()
	flag_RF = 1
	for i in range(0, len(p1)):
		if p1[i] != 10 + i: flag_RF = 0
	if flag_RF and p2 == p2[0] * len(p2):
		return [10]
	# Straight Flush: All cards are consecutive values of same suit.
	flag_SF = 1
	for i in range(1, len(p1)):
		if not p1[i] == p1[i - 1] + 1:
			flag_SF = 0
	if flag_SF and p2 == p2[0] * len(p2):
		return [9, p1[0]]
	# Four of a Kind: Four cards of the same value.
	if p1[0] == p1[1] == p1[2] == p1[3]: return [8, p1[0], p1[4]]
	if p1[1] == p1[2] == p1[3] == p1[4]: return [8, p1[1], p1[0]]
	# Full House: Three of a kind and a pair.
	if p1[0] == p1[1] == p1[2] and p1[3] == p1[4]:
		return [7, p1[0], p1[3]]
	if p1[0] == p1[1] and p1[2] == p1[3] == p1[4]:
		return [7,  p1[2], p1[0]]
	# Flush: All cards of the same suit.
	if p2 == p2[0] * len(p2): return [6, p1[4], p1[3], p1[2], p1[1], p1[0]]
	# Straight: All cards are consecutive values.
	flag_FOAK = 1
	for i in range(1, len(p1)):
		if not p1[i] == p1[i - 1] + 1:
			flag_FOAK = 0
	if flag_FOAK: return [5, p1[0]]
	# Three of a Kind: Three cards of the same value.
	if p1[0] == p1[1] == p1[2]: return [4, p1[0], p1[4], p1[3]]
	if p1[1] == p1[2] == p1[3]: return [4, p1[1], p1[4], p1[0]]
	if p1[2] == p1[3] == p1[4]: return [4, p1[2], p1[1], p1[0]]
	# Two Pairs: Two different pairs.
	if p1[0] == p1[1]:
		if p1[2] == p1[3]: return [3, p1[2], p1[0]]
		if p1[3] == p1[4]: return [3, p1[3], p1[0]]
	if p1[1] == p1[2]:
		if p1[3] == p1[4]: return [3, p1[3], p1[1]]
	# One Pair: Two cards of the same value.
	if p1[0] == p1[1]: return [2, p1[0], p1[4]]
	if p1[1] == p1[2]: return [2, p1[1], p1[4]]
	if p1[2] == p1[3]: return [2, p1[2], p1[4]]
	if p1[3] == p1[4]: return [2, p1[3], p1[4]]
	# High Card: Highest value card.
	return [1, p1[4], p1[3], p1[2], p1[1], p1[0]]

def compare(f1, f2):
	for i in range(0, len(f1)):
		if f1[i] != f2[i]: return f1[i] > f2[i]

if __name__ == '__main__':
	for i in range(2, 10):
		s[str(i)] = i
	s['T'] = 10
	s['J'] = 11
	s['Q'] = 12
	s['K'] = 13
	s['A'] = 14
	f = open('p054_poker.txt')
	line = f.readline()
	cnt = 0
	while line:
		line = line.replace('\n', '')
		ff = line.split(' ')
		cnt += compare(getS(ff[0:5:1]), getS(ff[5:10:1]))
		line = f.readline()
	print(cnt)