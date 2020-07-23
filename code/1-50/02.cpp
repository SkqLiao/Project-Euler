#include <bits/stdc++.h>

int main() {
	int a = 1, b = 1, sum = 0;
	while (a <= 4E6) {
		int tmp = a;
		a += b;
		b = tmp;
		if (a % 2 == 0) sum += a;
	}
	printf("%d", sum);
	return 0;
}