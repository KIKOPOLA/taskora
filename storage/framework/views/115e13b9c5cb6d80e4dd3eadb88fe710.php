<section>
    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    <form method="post" action="<?php echo e(route('profile.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?php echo e(__('Name')); ?></label>
                <input id="name" name="name" type="text"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name" />
                <?php $__errorArgs = ['name'];
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

            <!-- Email -->
            <div>
                <label for="email"
                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?php echo e(__('Email')); ?></label>
                <input id="email" name="email" type="email"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium text-slate-900"
                    value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username" />
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-[10px] font-bold mt-1 uppercase"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail()): ?>
                    <div class="mt-4 p-4 bg-amber-50 rounded-lg border border-amber-100">
                        <p class="text-xs text-amber-700 font-bold uppercase mb-2">
                            <?php echo e(__('Your email address is unverified.')); ?>

                        </p>
                        <button form="send-verification"
                            class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest">
                            <?php echo e(__('Resend Verification Email')); ?>

                        </button>

                        <?php if(session('status') === 'verification-link-sent'): ?>
                            <p class="mt-2 text-[10px] font-bold text-emerald-600 uppercase">
                                <?php echo e(__('A new verification link has been sent.')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6 mt-6 border-t border-slate-100">
            <button type="submit"
                class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                <?php echo e(__('Update Profile')); ?>

            </button>

            <?php if(session('status') === 'profile-updated'): ?>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600 uppercase tracking-widest"><?php echo e(__('Success: Updated')); ?></p>
            <?php endif; ?>
        </div>
    </form>
</section><?php /**PATH C:\laragon\www\taskora\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>