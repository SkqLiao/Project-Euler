#include <bits/stdc++.h>

int main() {
	int ans = 0;
	for (int i = 1; i < 1000; ++i) {
		if (i % 3 == 0 || i % 5 == 0) ans += i;
	}
	printf("%d", ans);
	return 0;
}