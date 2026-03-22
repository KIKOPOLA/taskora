<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Taskora') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-900">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-blue-900 via-slate-900 to-slate-950">
        <div class="mb-8">
            <a href="/">
                <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo"
                    class="h-16 w-auto drop-shadow-2xl">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-10 py-10 bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-blue-100">
            {{ $slot }}
        </div>

        <p class="mt-8 text-slate-500 text-xs font-bold uppercase tracking-[0.3em]">Taskora Secure Access</p>
    </div>
</body>

</html>