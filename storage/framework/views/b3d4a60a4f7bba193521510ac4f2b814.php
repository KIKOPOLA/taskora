

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('projects.index')); ?>"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Projects</span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create New Project</h1>
        <p class="text-slate-500 text-sm">Fill in the details below to initialize a new project.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <form action="<?php echo e(route('projects.store')); ?>" method="POST" class="p-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <!-- Project Name -->
                    <div>
                        <label for="name"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Project Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required value="<?php echo e(old('name')); ?>"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900"
                            placeholder="e.g. Website Redesign">
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

                    <!-- Description -->
                    <div>
                        <label for="description"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description</label>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 resize-none"
                            placeholder="Describe the project goals and scope..."><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
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

                    <!-- Status -->
                    <div>
                        <label for="status"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Status <span
                                class="text-red-500">*</span></label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                            <option value="planning" <?php echo e(old('status') === 'planning' ? 'selected' : ''); ?>>Planning</option>
                            <option value="in_progress" <?php echo e(old('status') === 'in_progress' ? 'selected' : ''); ?>>In Progress
                            </option>
                            <option value="completed" <?php echo e(old('status') === 'completed' ? 'selected' : ''); ?>>Completed</option>
                            <option value="on_hold" <?php echo e(old('status') === 'on_hold' ? 'selected' : ''); ?>>On Hold</option>
                        </select>
                        <?php $__errorArgs = ['status'];
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

                <div class="space-y-6">
                    <!-- Dates Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_date"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Start
                                Date</label>
                            <input type="date" id="start_date" name="start_date" value="<?php echo e(old('start_date')); ?>"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900">
                            <?php $__errorArgs = ['start_date'];
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

                        <div>
                            <label for="end_date"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">End
                                Date</label>
                            <input type="date" id="end_date" name="end_date" value="<?php echo e(old('end_date')); ?>"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900">
                            <?php $__errorArgs = ['end_date'];
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

                    <!-- Members Multi-select -->
                    <div>
                        <label for="members"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Team
                            Members</label>
                        <select id="members" name="members[]" multiple
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900"
                            style="height: 180px;">
                            <?php $__currentLoopData = $availableMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($member->id); ?>" class="py-1"><?php echo e($member->name); ?>

                                    (<?php echo e(ucfirst($member->role)); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p class="text-[10px] text-slate-400 mt-2 italic font-medium">Hold Ctrl (CMD) to select multiple
                            members</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 mt-12 pt-8 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                    <span>Create Project</span>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/projects/create.blade.php ENDPATH**/ ?>