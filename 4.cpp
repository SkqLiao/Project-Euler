#include <bits/stdc++.h>

bool check(int x) {
	static char a[10] = {'\0'};
	sprintf(a, "%d", x);
	std::string s = a, s2 = s;
	std::reverse(s.begin(), s.end());
	return s == s2;
}

int main() {
	int ans = 0;
	for (int i = 999; i >= 100; --i) {
		for (int j = i; j >= 100; --j) {
			if (check(i * j)) ans = std::max(ans, i * j);
		}
	}
	printf("%d\n", ans);
	return 0;
}