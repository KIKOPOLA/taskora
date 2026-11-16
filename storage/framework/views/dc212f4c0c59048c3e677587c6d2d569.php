

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Users Management</h1>
        <p class="text-slate-500 text-sm">Directory of all accounts within the system.</p>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <?php if($users->isEmpty()): ?>
            <div class="p-20 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users-slash text-2xl text-slate-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">No users found</h3>
                <p class="text-slate-500 text-sm">The user directory is currently empty.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th
                                class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                Name</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                Email</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap text-center">
                                Role</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap text-center">
                                Status</th>
                            <th
                                class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic-none">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded bg-slate-900 flex items-center justify-center text-white font-bold text-[10px] shadow-sm">
                                            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                        </div>
                                        <span class="text-sm font-bold text-slate-900"><?php echo e($user->name); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-xs font-medium text-slate-500"><?php echo e($user->email); ?></span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                                <?php if($user->role === 'admin'): ?> bg-red-50 text-red-700
                                                <?php elseif($user->role === 'pm'): ?> bg-blue-50 text-blue-700
                                                <?php elseif($user->role === 'member'): ?> bg-emerald-50 text-emerald-700
                                                <?php else: ?> bg-slate-100 text-slate-600
                                                <?php endif; ?>">
                                        <?php echo e($user->role); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <?php if($user->is_active): ?>
                                        <span class="inline-flex items-center gap-1.5 text-emerald-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="text-[10px] font-bold uppercase">Active</span>
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 text-slate-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                            <span class="text-[10px] font-bold uppercase">Inactive</span>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="<?php echo e(route('users.edit', $user)); ?>"
                                            class="p-1.5 text-slate-400 hover:text-slate-900 transition-colors" title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" class="inline"
                                            onsubmit="return confirm('Delete user?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-1.5 text-slate-300 hover:text-red-500 transition-colors"
                                                title="Delete">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/users/index.blade.php ENDPATH**/ ?>