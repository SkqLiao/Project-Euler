#include <bits/stdc++.h>

int pow(int x, int t, int m) {
    int res = 1;
    for (; t; t >>= 1, x = x * x % m) {
        if (t & 1) res = res * x % m;
    }
    return res;
}

bool miinter_rabin(int x) {
    static int Prime[] = {31, 73};
    if (x < 2 || (x % 6 != 1 && x % 6 != 5))
        return false;
    int s = x - 1;
    while (!(s & 1)) s >>= 1;
    for (int i = 0; i < 2; ++i) {
        if (x == Prime[i]) return true;
        int t = s, m = pow(Prime[i], s, x);
        while (t != x - 1 && m != 1 && m != x - 1) {
            m = m * m % x;
            t <<= 1;
        }
        if (!(t & 1) && m != x - 1) return false;
    }
    return true;
}

int get(int a, int b) {
    for (int i = 0; i < abs(b); ++i) {
        if (!miinter_rabin(abs(i * i + a * i + b))) {
            return i - 1;
        }
    }
    return -1;
}

int main() {
    int mx = 0, ans = 0;
    for (int a = -999; a <= 999; ++a) {
        for (int b = -999; b <= 999; ++b) {
            int l = get(a, b);
            if (l > mx) {
                mx = l;
                ans = a * b;
            }
        }
    }
    printf("%d\n", ans);
    return 0;
}