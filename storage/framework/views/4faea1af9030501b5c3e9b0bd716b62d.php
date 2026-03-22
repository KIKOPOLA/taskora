

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('projects.show', $project)); ?>"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to <?php echo e($project->name); ?></span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create New Task</h1>
        <p class="text-slate-500 text-sm">Create a new task for project <span
                class="font-bold text-slate-700"><?php echo e($project->name); ?></span></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <form action="<?php echo e(route('tasks.store', $project)); ?>" method="POST" class="p-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <!-- Task Title -->
                    <div>
                        <label for="title"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Task Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" required value="<?php echo e(old('title')); ?>"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900"
                            placeholder="e.g. Implement Login API">
                        <?php $__errorArgs = ['title'];
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
                            placeholder="Provide details about the task requirements..."><?php echo e(old('description')); ?></textarea>
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
                </div>

                <div class="space-y-6">
                    <!-- Personnel & Priority Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="assigned_to"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Assignee <span
                                    class="text-red-500">*</span></label>
                            <select id="assigned_to" name="assigned_to" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="">-- Select Member --</option>
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($member->id); ?>" <?php if(old('assigned_to') == $member->id): ?> selected <?php endif; ?>>
                                        <?php echo e($member->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['assigned_to'];
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
                            <label for="priority"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Priority <span
                                    class="text-red-500">*</span></label>
                            <select id="priority" name="priority" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="low" <?php if(old('priority') == 'low'): ?> selected <?php endif; ?>>Low</option>
                                <option value="medium" <?php if(old('priority') == 'medium' || !old('priority')): ?> selected <?php endif; ?>>
                                    Medium</option>
                                <option value="high" <?php if(old('priority') == 'high'): ?> selected <?php endif; ?>>High</option>
                                <option value="urgent" <?php if(old('priority') == 'urgent'): ?> selected <?php endif; ?>>Urgent</option>
                            </select>
                            <?php $__errorArgs = ['priority'];
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

                    <!-- Status & Due Date Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="status"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Status <span
                                    class="text-red-500">*</span></label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="to_do" <?php if(old('status') == 'to_do'): ?> selected <?php endif; ?>></option>
                                <option value="in_progress" <?php if(old('status') == 'in_progress'): ?> selected <?php endif; ?>>In Progress
                                </option>
                                <option value="review" <?php if(old('status') == 'review'): ?> selected <?php endif; ?>>Review</option>
                                <option value="completed" <?php if(old('status') == 'completed'): ?> selected <?php endif; ?>>Completed</option>
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

                        <div>
                            <label for="due_date"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Due
                                Date</label>
                            <input type="date" id="due_date" name="due_date" value="<?php echo e(old('due_date')); ?>"
                                min="<?php echo e($project->start_date->format('Y-m-d')); ?>"
                                max="<?php echo e($project->end_date->format('Y-m-d')); ?>"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900">
                            <?php $__errorArgs = ['due_date'];
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
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 mt-12 pt-8 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                    <span>Create Task</span>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/tasks/create.blade.php ENDPATH**/ ?>