<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('Name') }}</label>
                <input id="name" name="name" type="text"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('Email') }}</label>
                <input id="email" name="email" type="email"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @error('email')
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 rounded-lg border border-amber-100">
                        <p class="text-xs text-amber-700 font-bold uppercase mb-2">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification"
                            class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest">
                            {{ __('Resend Verification Email') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-[10px] font-bold text-emerald-600 uppercase">
                                {{ __('A new verification link has been sent.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6 mt-6 border-t border-slate-100">
            <button type="submit"
                class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                {{ __('Update Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600 uppercase tracking-widest">{{ __('Success: Updated') }}</p>
            @endif
        </div>
    </form>
</section>