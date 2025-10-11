<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-4 border border-yellow-500 rounded-lg bg-yellow-50 dark:bg-yellow-900/20">
                    <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-300 mb-2">
                        ⚠️ {{ __('Verifikasi diperlukan!') }}
                    </p>
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Alamat email Anda belum diverifikasi. Verifikasi diperlukan untuk keamanan penuh.') }}
                    </p>

                    {{-- TOMBOL UTAMA VERIFIKASI (Bentuknya lebih menonjol) --}}
                    <button form="send-verification"
                        class="mt-3 inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Kirim Ulang Link Verifikasi') }}
                    </button>
                    {{-- END TOMBOL UTAMA --}}

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Link verifikasi baru telah dikirimkan ke email Anda. Mohon cek kotak masuk Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
