#include <bits/stdc++.h>

const int MAXN = 1E7;

std::vector<int> Prime;
std::bitset<MAXN> isnPri;

int main() {
	for (int i = 2; Prime.size() <= 10000; ++i) {
		if (!isnPri[i]) {
			Prime.push_back(i);
		}
		for (size_t j = 0; j < Prime.size(); ++j) {
			int cur = i * Prime[j];
			if (cur >= MAXN)
				break;
			isnPri[cur] = 1;
			if (i % Prime[j] == 0) break;
		}
	}
	printf("%d\n", Prime.back());
	return 0;
}