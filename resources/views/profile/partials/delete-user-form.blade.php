<section class="space-y-6">
    <p class="text-sm text-slate-700">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
    >
        <i class="fas fa-trash"></i>{{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-red-800 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-2 text-slate-700">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="{{ __('Password') }}"
                    />
                    @error('password', 'userDeletion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                    <button 
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition-colors duration-200"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button 
                        type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
                    >
                        <i class="fas fa-trash"></i>{{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
