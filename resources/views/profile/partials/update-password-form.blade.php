<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <!-- Current Password -->
            <div>
                <label for="update_password_current_password"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="current-password" />
                @error('updatePassword.current_password')
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="update_password_password"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="new-password" />
                @error('updatePassword.password')
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="update_password_password_confirmation"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('Confirm Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="new-password" />
                @error('updatePassword.password_confirmation')
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6 mt-6 border-t border-slate-100">
            <button type="submit"
                class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600 uppercase tracking-widest">{{ __('Success: Updated') }}</p>
            @endif
        </div>
    </form>
</section>