#include <bits/stdc++.h>

typedef long long ll;

int Prime[100], Cnt[40], cnt;
std::bitset<1000> isnPri;

void EulerPrime(int x) {
	for (int i = 2; i <= x; ++i) {
		if (!isnPri[i]) Prime[cnt++] = i;
		for (int j = 0; j < cnt; ++j) {
			int cur = i * Prime[j];
			if (cur > x) break;
			isnPri[cur] = 1;
			if (i % Prime[j] == 0) break;
		}
	}	
}

ll mul(ll x, ll y, ll m) {
    x %= m, y %= m;
    return (x * y - m * (ll)((long double)x / m * y) % m + m) % m;
}

ll pow(ll x, ll t, ll m) {
    ll res = 1;
    for (; t; t >>= 1, x = mul(x, x, m)) {
        if (t & 1) {
            res = mul(res, x, m);
        }
    }
    return res;
}

bool miller_rabin(ll x) {
    static ll Prime[] = {2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41};
    if (x == 2 || x == 3) {
        return true;
    }
    if (x < 2 || (x % 6 != 1 && x % 6 != 5)) {
        return false;
    }
    ll s = x - 1;
    while (!(s & 1)) {
        s >>= 1;
    }
    for (int i = 0; i < 13; ++i) {
        if (x == Prime[i]) {
            return true;
        }
        ll t = s, m = pow(Prime[i], s, x);
        while (t != x - 1 && m != 1 && m != x - 1) {
            m = mul(m, m, x);
            t <<= 1;
        }
        if (!(t & 1) && m != x - 1) {
            return false;
        }
    }
    return true;
}

int calFactor(long long x) {
	printf("%lld::\n", x);
	int num = 1;
	for (int i = 0; i < cnt && x != 1; ++i) {
		Cnt[i] = 0;
		while (x % Prime[i] == 0) {
			x /= Prime[i];
			++Cnt[i];
		}
		if (Cnt[i])
			printf("%d:%d\n", Prime[i], Cnt[i]);
		if (miller_rabin(x)) {
			num = 2;
			break;
		}
	}
	for (int i = 0; i < cnt; ++i) {
		num *= (Cnt[i] + 1);
	}
	return num;
}


int main() {
	EulerPrime(1000);
	return 0;
	for (long long i = 1, cur = 2; ; i += cur++) {
		if (i > 1e9) return 0;
		int x = calFactor(i);
		//printf("%lld: %d\n", i, x);
		if (x == 500) {
			printf("%lld\n", i);
			return 0;
		}
	}
	return 0;
}