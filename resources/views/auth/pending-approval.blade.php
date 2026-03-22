<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
            {{ __('Account Pending Approval') }}
        </h2>
        <p class="mb-4">
            {{ __('Thank you for registering! Your account is currently pending approval from an administrator. You will not be able to access the dashboard until your account has been verified and assigned a role.') }}
        </p>
        <p>
            {{ __('Please check back later or contact support if you believe this is a mistake.') }}
        </p>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <button onclick="window.location.reload()"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out text-sm">
            {{ __('Check Status') }}
        </button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>