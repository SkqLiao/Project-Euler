#include <bits/stdc++.h>

int main() {
	int res = 0;
	for (int i = 1; i <= 100; ++i) {
		res += i * i;
	}
	printf("%d\n", 5050 * 5050 - res);
	return 0;
}