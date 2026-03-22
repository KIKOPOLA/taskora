

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('tasks.show', $task)); ?>"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200 mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Return to Task Details</span>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Assignment Amendment</h1>
        <p class="text-slate-500 mt-1">Adjusting operational parameters for: <span
                class="font-bold text-slate-700"><?php echo e($task->title); ?></span></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <div class="p-8 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Amendment Protocol</h2>
            <span
                class="text-[10px] font-bold px-2 py-0.5 bg-amber-50 text-amber-600 rounded-full border border-amber-100">EDIT
                MODE</span>
        </div>

        <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST" class="p-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <!-- Task Title -->
                    <div>
                        <label for="title"
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                            Task Designation <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required value="<?php echo e(old('title', $task->title)); ?>"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description"
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Operational
                            Instructions</label>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 resize-none"><?php echo e(old('description', $task->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?></p>
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
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Assigned
                                Agent</label>
                            <select id="assigned_to" name="assigned_to"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 appearance-none cursor-pointer">
                                <option value="">-- Select Member --</option>
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($member->id); ?>" <?php if(old('assigned_to', $task->assigned_to) == $member->id): ?>
                                    selected <?php endif; ?>>
                                        <?php echo e($member->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['assigned_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="priority"
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                                Criticality Level <span class="text-rose-500">*</span>
                            </label>
                            <select id="priority" name="priority" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 appearance-none cursor-pointer">
                                <option value="low" <?php if(old('priority', $task->priority) == 'low'): ?> selected <?php endif; ?>>Routine
                                </option>
                                <option value="medium" <?php if(old('priority', $task->priority) == 'medium'): ?> selected <?php endif; ?>>
                                    Standard</option>
                                <option value="high" <?php if(old('priority', $task->priority) == 'high'): ?> selected <?php endif; ?>>Elevated
                                </option>
                                <option value="urgent" <?php if(old('priority', $task->priority) == 'urgent'): ?> selected <?php endif; ?>>
                                    Immediate</option>
                            </select>
                            <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?>

                                </p>
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
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                                Operation Phase <span class="text-rose-500">*</span>
                            </label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 appearance-none cursor-pointer">
                                <option value="to_do" <?php if(old('status', $task->status) == 'to_do'): ?> selected <?php endif; ?>>Backlog
                                </option>
                                <option value="in_progress" <?php if(old('status', $task->status) == 'in_progress'): ?> selected
                                <?php endif; ?>>In Operation</option>
                                <option value="review" <?php if(old('status', $task->status) == 'review'): ?> selected <?php endif; ?>>Review
                                    Phase</option>
                                <option value="completed" <?php if(old('status', $task->status) == 'completed'): ?> selected <?php endif; ?>>
                                    Finalized</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="due_date"
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Deadline</label>
                            <input type="date" id="due_date" name="due_date"
                                value="<?php echo e(old('due_date', $task->due_date?->format('Y-m-d'))); ?>"
                                min="<?php echo e($task->project->start_date->format('Y-m-d')); ?>"
                                max="<?php echo e($task->project->end_date->format('Y-m-d')); ?>"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900">
                            <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter"><?php echo e($message); ?>

                                </p>
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
                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    <i class="fas fa-save text-xs"></i>
                    <span>Synchronize Changes</span>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/tasks/edit.blade.php ENDPATH**/ ?>