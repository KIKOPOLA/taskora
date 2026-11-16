<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taskora - Professional Project Management Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        .animate-slide-down {
            animation: slideInDown 0.6s ease-out;
        }

        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.25);
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateX(8px);
            box-shadow: 0 10px 30px -5px rgba(37, 99, 235, 0.2);
        }

        .key-feature:hover {
            transform: translateY(-8px);
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-neutral-900">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-black/95 backdrop-blur-md border-b border-neutral-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="flex items-center gap-2 group transition-transform hover:scale-105">
                    <img src="<?php echo e(asset('images/Taskora Logo.png')); ?>" alt="Taskora Logo"
                        class="h-16 w-auto drop-shadow-md">
                </a>
                <div class="flex items-center gap-3 md:gap-6">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>"
                            class="px-4 py-2 text-sm font-semibold text-neutral-200 hover:text-white transition-colors">
                            <i class="fas fa-chart-line mr-2"></i>
                            Dashboard
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-semibold text-neutral-200 hover:text-white transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-neutral-200 hover:text-white transition-colors">
                            <i class="fas fa-sign-in-alt"></i>
                            Sign In
                        </a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>"
                                class="px-6 py-2.5 bg-primary-600 hover:bg-primary-500 text-white rounded-lg font-semibold transition-all shadow-md hover:shadow-lg active:scale-95 text-sm inline-flex items-center gap-2">
                                <i class="fas fa-rocket"></i>
                                Get Started
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 pb-20 overflow-hidden bg-neutral-50">
        <!-- Background Elements -->
        <div class="absolute top-40 right-0 w-96 h-96 bg-primary-50 rounded-full blur-3xl -z-10 opacity-70"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-neutral-100 rounded-full blur-3xl -z-10 opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Content -->
                <div class="animate-slide-up">
                    <div class="inline-block mb-6">
                        <div class="px-4 py-2 bg-white rounded-full border border-neutral-200 shadow-sm">
                            <p class="text-sm font-semibold text-primary-700">
                                <i class="fas fa-star text-amber-400 mr-2"></i>Professional Project Management
                            </p>
                        </div>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6 text-neutral-900">
                        Manage Projects with <span class="text-primary-600">Confidence</span>
                    </h1>

                    <p class="text-lg text-neutral-600 mb-10 leading-relaxed max-w-lg">
                        Taskora is a professional project management platform designed for corporate teams.
                        Collaborate seamlessly, organize efficiently, and deliver exceptional results.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('register')); ?>"
                                class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center gap-2 text-lg">
                                Start Free Trial
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="<?php echo e(route('login')); ?>"
                                class="px-8 py-4 bg-white hover:bg-neutral-50 border border-neutral-200 text-neutral-900 rounded-lg font-semibold transition-all inline-flex items-center justify-center gap-2 text-lg shadow-sm">
                                Login
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/dashboard')); ?>"
                                class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center gap-2 text-lg">
                                Open Dashboard
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Trust Badge -->
                    <div class="mt-12 pt-8 border-t border-neutral-200">
                        <p class="text-xs font-semibold text-neutral-500 uppercase tracking-widest mb-4">Trusted By</p>
                        <div class="flex items-center gap-8">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-emerald-600"></i>
                                <span class="text-sm text-neutral-700 font-medium">Secure & Reliable</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-emerald-600"></i>
                                <span class="text-sm text-neutral-700 font-medium">Enterprise Grade</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="animate-slide-down hidden lg:block">
                    <div class="relative">
                        <!-- Decorative Card -->
                        <div
                            class="bg-white rounded-2xl border border-neutral-200 p-8 shadow-2xl hover:shadow-3xl transition-all">
                            <div class="space-y-6">
                                <!-- Stat 1 -->
                                <div
                                    class="stat-card flex items-center gap-4 p-4 bg-neutral-50 rounded-xl cursor-default border border-neutral-100">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-primary-600 flex items-center justify-center text-white text-xl shadow-md">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-neutral-900">100+</p>
                                        <p class="text-sm text-neutral-600 font-medium">Active Projects</p>
                                    </div>
                                </div>

                                <!-- Stat 2 -->
                                <div
                                    class="stat-card flex items-center gap-4 p-4 bg-neutral-50 rounded-xl cursor-default border border-neutral-100">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-emerald-600 flex items-center justify-center text-white text-xl shadow-md">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-neutral-900">1000+</p>
                                        <p class="text-sm text-neutral-600 font-medium">Team Members</p>
                                    </div>
                                </div>

                                <!-- Stat 3 -->
                                <div
                                    class="stat-card flex items-center gap-4 p-4 bg-neutral-50 rounded-xl cursor-default border border-neutral-100">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-amber-500 flex items-center justify-center text-white text-xl shadow-md">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-neutral-900">10K+</p>
                                        <p class="text-sm text-neutral-600 font-medium">Tasks Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-neutral-900 mb-4">
                    Complete Features for <span class="text-primary-600">Every Role</span>
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                    Taskora provides comprehensive tools tailored for Administrators, Project Managers, and Team
                    Members.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Admin Features -->
                <div
                    class="feature-card bg-neutral-50 rounded-2xl border border-neutral-200 p-8 hover:border-primary-400 shadow-sm hover:shadow-xl">
                    <div class="mb-6">
                        <div
                            class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-amber-100 text-amber-600 text-2xl mb-4">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900">Administrator</h3>
                    </div>
                    <p class="text-neutral-600 mb-6">
                        Full system control with comprehensive user and project management capabilities.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">User Management</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">System Overview</span>
                        </li>
                    </ul>
                </div>

                <!-- PM Features -->
                <div
                    class="feature-card bg-neutral-50 rounded-2xl border border-neutral-200 p-8 hover:border-primary-400 shadow-sm hover:shadow-xl">
                    <div class="mb-6">
                        <div
                            class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-primary-100 text-primary-600 text-2xl mb-4">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900">Project Manager</h3>
                    </div>
                    <p class="text-neutral-600 mb-6">
                        Create and manage projects, assign tasks, and track team progress efficiently.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">Project Creation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">Task Assignment</span>
                        </li>
                    </ul>
                </div>

                <!-- Member Features -->
                <div
                    class="feature-card bg-neutral-50 rounded-2xl border border-neutral-200 p-8 hover:border-primary-400 shadow-sm hover:shadow-xl">
                    <div class="mb-6">
                        <div
                            class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-emerald-100 text-emerald-600 text-2xl mb-4">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900">Team Member</h3>
                    </div>
                    <p class="text-neutral-600 mb-6">
                        Collaborate on projects, complete tasks, and stay ahead with real-time notifications.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">Task Management</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check text-primary-600"></i>
                            <span class="text-sm text-neutral-700">Collaboration Tools</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-neutral-900 text-neutral-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="border-t border-neutral-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-neutral-500">© 2026 Taskora. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html><?php /**PATH C:\laragon\www\taskora\resources\views/welcome.blade.php ENDPATH**/ ?>