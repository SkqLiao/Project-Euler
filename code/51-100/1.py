
def prime(n):
	a = [1 for i in range(n)]
	a[0], a[1], a[2] = 0, 0, 1
	pl = []
	t = s = 0
	for i in range(2,n):
		if a[i]:
			s+=i
			pl.append(i)
			j=i*i
			t+=1
			while j<n:
				a[j]=0
				j+=i
	return pl
 
def isprime(n, prime_list):
	if n in prime_list:
		return True
	for i in prime_list:
		if n<i:
			return True
		if n%i == 0:
			return False
	return True
 
def main():
	prime_list = prime(100000)
	count_prime = 0
	now = 1
	circle = 1
	while True:
		circle += 1
		now += circle
		if isprime(now,prime_list):
			count_prime += 1
		for i in range(3):
			now += 2*circle-2
			if isprime(now,prime_list):
				count_prime += 1
		if count_prime/(4*circle-3)<0.1:
			print(2*circle-1)
			break
		now += circle-1
 
if __name__ == '__main__':
	main()