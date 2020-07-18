#include <bits/stdc++.h>

int main() {
	for (int i = 1; i < 1000; ++i) {
		for (int j = i; j < 1000 - i; ++j) {
			if (i * i + j * j == (1000 - i - j) * (1000 - i - j)) {
				printf("%d\n", i * j * (1000 - i - j));
			}
		}
	}
	return 0;
}