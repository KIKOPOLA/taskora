<section class="space-y-6">
    <p class="text-sm text-slate-700">
        <?php echo e(__('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')); ?>

    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
    >
        <i class="fas fa-trash"></i><?php echo e(__('Delete Account')); ?>

    </button>

    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'confirm-user-deletion','show' => $errors->userDeletion->isNotEmpty(),'focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'confirm-user-deletion','show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->userDeletion->isNotEmpty()),'focusable' => true]); ?>
        <div class="p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-red-800 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                    <?php echo e(__('Are you sure you want to delete your account?')); ?>

                </h2>

                <p class="mt-2 text-slate-700">
                    <?php echo e(__('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')); ?>

                </p>
            </div>

            <form method="post" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2"><?php echo e(__('Password')); ?></label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="<?php echo e(__('Password')); ?>"
                    />
                    <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                    <button 
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition-colors duration-200"
                    >
                        <?php echo e(__('Cancel')); ?>

                    </button>

                    <button 
                        type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
                    >
                        <i class="fas fa-trash"></i><?php echo e(__('Delete Account')); ?>

                    </button>
                </div>
            </form>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
</section>
<?php /**PATH C:\laragon\www\taskora\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>