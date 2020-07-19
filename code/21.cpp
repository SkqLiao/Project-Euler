#include <bits/stdc++.h>

int get(int x) {
	int sum = 1;
	for (int i = 2; i <= sqrt(x); ++i) {
		if (x % i == 0) {
			sum += i + x / i;
		}
	}
	return sum;
}

int Sum[10005];

void bf() {
	int ans = 0;
	for (int i = 1; i <= 10000; ++i) Sum[i] = get(i);
	for (int i = 1; i <= 10000; ++i) {
		if (Sum[i] > 10000) continue;
		if (Sum[Sum[i]] == i && i != Sum[i]) ans += i;
	}
	printf("%d\n", ans);
}

int main() {
	bf();
	return 0;
}