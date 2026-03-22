<section>
    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="space-y-4">
            <!-- Current Password -->
            <div>
                <label for="update_password_current_password"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?php echo e(__('Current Password')); ?></label>
                <input id="update_password_current_password" name="current_password" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="current-password" />
                <?php $__errorArgs = ['updatePassword.current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- New Password -->
            <div>
                <label for="update_password_password"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?php echo e(__('New Password')); ?></label>
                <input id="update_password_password" name="password" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="new-password" />
                <?php $__errorArgs = ['updatePassword.password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="update_password_password_confirmation"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?php echo e(__('Confirm Password')); ?></label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    autocomplete="new-password" />
                <?php $__errorArgs = ['updatePassword.password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6 mt-6 border-t border-slate-100">
            <button type="submit"
                class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                <?php echo e(__('Update Password')); ?>

            </button>

            <?php if(session('status') === 'password-updated'): ?>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600 uppercase tracking-widest"><?php echo e(__('Success: Updated')); ?></p>
            <?php endif; ?>
        </div>
    </form>
</section><?php /**PATH C:\laragon\www\taskora\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>