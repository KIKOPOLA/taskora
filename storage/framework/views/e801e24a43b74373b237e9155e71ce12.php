<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Taskora')); ?> - Corporate Project Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased text-neutral-800 bg-neutral-50 overflow-x-hidden">
    <div class="min-h-screen flex flex-col bg-neutral-50">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar - Fixed on desktop -->
            <?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-auto md:ml-72 transition-all duration-300 custom-scrollbar">
                <div class="w-full mx-auto p-6 md:p-10 lg:p-12 max-w-[1600px] min-h-screen">
                    <!-- Global Alerts System -->
                    <div class="space-y-4 mb-8">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-error shadow-soft animate-fade-in border-2">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center shadow-lg">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-black text-red-900 uppercase tracking-widest leading-none mb-1">
                                            Attention Required</h4>
                                        <p class="text-xs font-bold text-red-700 opacity-80 leading-none">The system
                                            encountered multiple validation errors.</p>
                                    </div>
                                </div>
                                <div class="mt-4 pl-14">
                                    <ul class="text-sm font-semibold text-red-800 space-y-1.5 list-disc">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success shadow-soft animate-fade-in border-2">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-lg">
                                        <i class="fas fa-check-circle text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4
                                            class="text-sm font-black text-emerald-900 uppercase tracking-widest leading-none mb-1">
                                            Process Complete</h4>
                                        <p class="text-xs font-bold text-emerald-700"><?php echo e(session('success')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            <div class="alert alert-error shadow-soft animate-fade-in border-2">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center shadow-lg">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4
                                            class="text-sm font-black text-red-900 uppercase tracking-widest leading-none mb-1">
                                            Operation Failed</h4>
                                        <p class="text-xs font-bold text-red-700"><?php echo e(session('error')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Page Content -->
                    <div class="animate-slide-up">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>

                <!-- Footer (Optional for Corporate) -->
                <footer class="p-10 border-t border-neutral-200 bg-white">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest">© <?php echo e(date('Y')); ?>

                            Taskora Corporate Platform. All Rights Reserved.</p>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>

</html><?php /**PATH C:\laragon\www\taskora\resources\views/layouts/app.blade.php ENDPATH**/ ?>