<x-guest-layout>
    <div class="mb-6 text-sm text-gray-500 leading-relaxed text-center">
        {{ __('Lupa kata sandi? Tidak masalah. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi untuk memilih yang baru.') }}
    </div>

    <x-auth-session-status class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-100" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block font-semibold text-sm text-gray-700 mb-1.5">Alamat Email</label>
            <input id="email" 
                class="block w-full px-4 py-3.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                placeholder="nama@email.com"
                required 
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4">
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-bold py-4 rounded-xl active:scale-[0.98] transition-all shadow-lg text-lg">
                {{ __('Kirim Tautan Reset') }}
            </button>

            <a href="{{ route('login') }}" class="text-center text-sm text-indigo-600 font-semibold hover:underline">
                {{ __('← Kembali ke Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>