#include <bits/stdc++.h>

int get(long long x) {
	int cnt = 0;
	while (x != 1) {
		if (x % 2 == 0) x /= 2;
		else x = x * 3 + 1;
		++cnt;
	}
	return cnt;
}

int main() {
	int mx = 0, ans;
	for (int i = 5e5; i <= 1e6; ++i) {
		int t = get(i);
		if (t > mx) {
			ans = i;
			mx = t;
		}
	}
	printf("%d : %d\n", ans, mx);
	return 0;
}