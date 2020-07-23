#include <bits/stdc++.h>

const int MAXN = 2E6;

std::vector<int> Prime;
std::bitset<MAXN> isnPri;

int main() {
	long long sum = 0;
	for (int i = 2; i < MAXN; ++i) {
		if (!isnPri[i]) {
			Prime.push_back(i);
			sum += i;
			// std::cout << i << "\n";
		}
		for (size_t j = 0; j < Prime.size(); ++j) {
			int cur = i * Prime[j];
			if (cur >= MAXN)
				break;
			isnPri[cur] = 1;
			if (i % Prime[j] == 0) break;
		}
	}
	std::cout << sum << "\n";
	return 0;
}