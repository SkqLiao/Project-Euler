#include <bits/stdc++.h>

int Num[8];
int Prime[8] = {2, 3, 5, 7, 11, 13, 17, 19};

int poww(int x, int t) {
	int res = 1;
	for (int cur = x; t; t >>= 1) {
		if (t & 1) res *= cur;
		cur *= cur;
	}
	return res;
}

int main() {
	for (int i = 1; i <= 20; ++i) {
		int tmp = i;
		for (int j = 0; j < 8; ++j) {
			if (tmp < Prime[j]) break;
			int cnt = 0;
			while (tmp % Prime[j] == 0) {
				++cnt;
				tmp /= Prime[j];
			}
			Num[j] = std::max(Num[j], cnt);
		}
	}
	long long ans = 1;
	for (int i = 0; i < 8; ++i) {
		ans *= poww(Prime[i], Num[i]);
	}
	printf("%lld\n", ans);
	return 0;
}