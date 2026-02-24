<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Username</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                placeholder="Masukkan username" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Password</label>
            <input type="password" name="password" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                placeholder="Masukkan password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4" name="remember">
                <span class="ms-2 text-sm text-gray-600 font-medium select-none">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 font-semibold hover:text-pink-500 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-bold py-4 rounded-xl active:scale-[0.98] transition-all shadow-lg text-lg flex items-center justify-center gap-2">
                Login →
            </button>
        </div>

        <div class="pt-2">
            <p class="text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>