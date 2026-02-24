<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Nama Lengkap</label>
            <x-text-input id="name" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                type="text" name="name" :value="old('name')" 
                required autofocus placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Email</label>
            <x-text-input id="email" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                type="email" name="email" :value="old('email')" 
                required placeholder="Masukkan email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Password</label>
            <x-text-input id="password" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                type="password" name="password" 
                required autocomplete="new-password" 
                placeholder="Buat password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1.5">Konfirmasi Password</label>
            <x-text-input id="password_confirmation" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                type="password" name="password_confirmation" 
                required autocomplete="new-password" 
                placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-bold py-4 rounded-xl active:scale-[0.98] transition-all shadow-lg text-lg">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        <div class="pt-2 text-center">
            <p class="text-sm text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">
                    Login
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>