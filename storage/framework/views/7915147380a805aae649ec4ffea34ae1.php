<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Profile Settings</h1>
        <p class="text-sm text-slate-500 mt-1">Manage your account information and security credentials.</p>
    </div>

    <div class="max-w-3xl space-y-10">
        <!-- Profile Information Section -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Public Identity</h2>
                <i class="fas fa-user-circle text-slate-300"></i>
            </div>
            <div class="p-8">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Security Configuration</h2>
                <i class="fas fa-key text-slate-300"></i>
            </div>
            <div class="p-8">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/profile/edit.blade.php ENDPATH**/ ?>