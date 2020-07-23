#include <bits/stdc++.h>

int F[] = {0, 1, 2, 3, 4, 5, 6, 7, 8, 9};

int main() {
	for (int i = 1; i < int(1E6); ++i)
		std::next_permutation(F, F + 10);
	for (int i = 0; i < 10; ++i) 
		printf("%d", F[i]);
	return 0;
}