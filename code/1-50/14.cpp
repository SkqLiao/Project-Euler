#include <bits/stdc++.h>

const int MAXN = 1e6 + 5;

std::map<long long, int> Ans;
std::vector<int> v;

int get(long long x) {
	v.clear();
	while (true) {
		v.push_back(x);
		if (x == 1 || Ans[x]) break;
		if (x % 2 == 0) x /= 2;
		else x = x * 3 + 1;
	}
	for (int i = v.size() - 2; i >= 0; --i) {
		Ans[v[i]] = Ans[v[i + 1]] + 1;
	}
	return Ans[v[0]];
}

int main() {
	int mx = 0, ans;
	for (int i = 2; i <= 1e6; ++i) {
		int t = get(i);
		if (t > mx) {
			ans = i;
			mx = t;
		}
	}
	printf("%d\n", ans);
	return 0;
}