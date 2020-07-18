#include <bits/stdc++.h>

int Days[] = {0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31};

bool isLeap(int year) {
	return (year % 4 == 0 && year % 100 != 0) || year % 400 == 0;
}

int get(int year, int month, int day) {
	int num = 0;
	for (int i = 1900; i < year; ++i) {
		num += 365 + isLeap(i);
	}
	for (int i = 1; i < month; ++i) {
		if (i == 2 && isLeap(year)) ++num;
		num += Days[i];
	}
	num += day;
	return num % 7;
}

int main() {
	int num = 0;
	for (int i = 1901; i <= 2000; ++i) {
		for (int j = 1; j <= 12; ++j) {
			num += !get(i, j, 1);
		}
	}
	printf("%d\n", num);
	return 0;
}