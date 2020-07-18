#include <bits/stdc++.h> 

std::string s[] = {"one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"};
std::string s2[] = {"eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"};
std::string s3[] = {"twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninty"};
std::string s4[] = {"hundred", "thousand"};

std::string getX(int x, int type=0) {
	if (x == 0) return "";
	std::string ans("");
	if (x <= 10) {
		ans = s[x - 1];
	} else if (x < 20) {
		ans = s2[x - 11];
	} else if (x < 100) {
		int ten = x / 10, one = x % 10;
		ans = s3[ten - 2];
		if (one > 0) ans += " " + s[one - 1];
	}
	return !type ? ans : " and " + ans;
}

int get(int x) {
	std::string ans("");
	if (x >= 100) {
		int hundred = x / 100;
		ans = s[hundred - 1] + " " + s4[0];
		ans += getX(x % 100, 1);
	} else {
		ans = getX(x);
	}
	int cnt = 0;
	for (size_t i = 0; i < ans.length(); ++i)
		if (isalpha(ans[i])) ++cnt;
	return cnt;
}

int main() {
	int total = 11;
	for (int i = 1; i < 1000; ++i) {
		total += get(i);
	}
	printf("%d\n", total);
	return 0;
}