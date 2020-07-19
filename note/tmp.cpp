#include <bits/stdc++.h>
#include <bits/extc++.h>

typedef long long ll;
const ll MOD = 998244353;

ll N;
std::vector<ll> A;
__gnu_pbds::cc_hash_table<ll, ll> S;

int main() {
	scanf("%d", &N);
	ll r = sqrt(N);
	for (ll i = 1; i <= r; ++i)
		A.push_back(N / i);
	for (ll i = A.back() - 1; i >= 1; --i)
		A.push_back(i);
	for (auto i : A) 
		S[i] = (i + 2) % MOD * ((i - 1) % MOD) / 2;
	ll tms = 0;
	for (ll p = 2; p <= r; ++p) {
		if (S[p] != S[p - 1]) {
			ll sp = S[p - 1];
			ll pp = p * p;
			for (auto i : A) {
				if (i < pp) break;
				S[i] = ((S[i] - p * (S[i / p] - sp)) % MOD + MOD) % MOD;
			}
		}
	}
	printf("%lld\n", S[N]);
	return 0;
}