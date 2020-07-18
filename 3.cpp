#include <bits/stdc++.h>

typedef long long ll;

ll n = 600851475143LL;

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

int main() {
	int mx = 0;
	for (int i = 1, _iend = sqrt(n); i <= _iend; ++i) {
		if (n % i == 0) {
			ll m = n / i;
			if (miller_rabin(m)) return printf("%lld\n", m), 0;
			if (miller_rabin(1LL * i)) mx = i;
		}
	}
	printf("%d", mx);
	return 0;
}
