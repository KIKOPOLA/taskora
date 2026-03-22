

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800 mb-2">
        <i class="fas fa-tasks text-blue-600 mr-2"></i><?php echo e($task->title); ?>

    </h1>
    <p class="text-slate-600"><?php echo e($task->project->name); ?></p>
</div>

<!-- Task Details Card -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div>
            <!-- Status -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Status</label>
                <span class="px-3 py-1.5 rounded-full text-sm font-semibold
                    <?php if($task->status === 'completed'): ?> bg-green-100 text-green-800
                    <?php elseif($task->status === 'in_progress'): ?> bg-blue-100 text-blue-800
                    <?php elseif($task->status === 'to_do'): ?> bg-slate-100 text-slate-800
                    <?php elseif($task->status === 'review'): ?> bg-yellow-100 text-yellow-800
                    <?php endif; ?>">
                    <?php echo e(str_replace('_', ' ', ucfirst($task->status))); ?>

                </span>
            </div>
            
            <!-- Priority -->
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Priority</label>
                <span class="px-3 py-1.5 rounded-full text-sm font-semibold
                    <?php if($task->priority === 'urgent'): ?> bg-red-100 text-red-800
                    <?php elseif($task->priority === 'high'): ?> bg-orange-100 text-orange-800
                    <?php elseif($task->priority === 'medium'): ?> bg-blue-100 text-blue-800
                    <?php else: ?> bg-green-100 text-green-800
                    <?php endif; ?>">
                    <?php echo e(ucfirst($task->priority)); ?>

                </span>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Assigned To -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Assigned To</label>
                <p class="text-lg font-semibold text-slate-800"><?php echo e($task->assignee?->name ?? 'Unassigned'); ?></p>
            </div>
            
            <!-- Due Date -->
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Due Date</label>
                <p class="text-lg font-semibold text-slate-800"><?php echo e($task->due_date?->format('d M Y') ?? '-'); ?></p>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="mt-8 pt-8 border-t border-slate-200">
        <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-3">Description</label>
        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">
            <?php echo e($task->description ?? 'No description provided'); ?>

        </p>
    </div>
</div>

<!-- Add Update Form -->
<?php if(Auth::user()->isMember() && $task->assigned_to == Auth::id()): ?>
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
        <i class="fas fa-plus-circle text-blue-600"></i>Add Update
    </h2>
    
    <form action="<?php echo e(route('task-updates.store', $task)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Notes -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-semibold text-slate-700 mb-2">
                Notes / Comments <span class="text-red-500">*</span>
            </label>
            <textarea id="notes" name="notes" rows="5" required 
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-vertical"
                placeholder="Describe your progress..."><?php echo e(old('notes')); ?></textarea>
            <?php $__errorArgs = ['notes'];
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

        <!-- Status -->
        <div class="mb-6">
            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Update Status</label>
            <select id="status" name="status" required
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                <option value="to_do" <?php if(old('status') == 'to_do'): ?> selected <?php endif; ?>>To Do</option>
                <option value="in_progress" <?php if(old('status', 'in_progress') == 'in_progress'): ?> selected <?php endif; ?>>In Progress</option>
                <option value="review" <?php if(old('status') == 'review'): ?> selected <?php endif; ?>>Review</option>
                <option value="completed" <?php if(old('status') == 'completed'): ?> selected <?php endif; ?>>Completed</option>
            </select>
            <?php $__errorArgs = ['status'];
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

        <!-- Photo/Screenshot -->
        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Upload Photo/Screenshot</label>
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            <small class="text-slate-600 text-xs mt-1 block">Max 2MB. Supported: JPG, PNG, GIF</small>
            <?php $__errorArgs = ['image'];
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

        <!-- Files -->
        <div class="mb-8">
            <label for="files" class="block text-sm font-semibold text-slate-700 mb-2">Upload Files</label>
            <input type="file" id="files" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.zip,.jpeg,.png,.jpg,.gif"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            <small class="text-slate-600 text-xs mt-1 block">Max 10MB each. Supported: PDF, DOC, DOCX, XLS, XLSX, TXT, ZIP, Images</small>
            <?php $__errorArgs = ['files.*'];
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

        <!-- Submit Button -->
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg">
            <i class="fas fa-paper-plane"></i>Submit Update
        </button>
    </form>
</div>
<?php endif; ?>

<!-- Updates List Section -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="p-8 border-b border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-history text-blue-600"></i>Updates (<?php echo e($updates->count()); ?>)
        </h2>
    </div>

    <!-- Updates Content -->
    <div class="p-8">
        <?php if($updates->isEmpty()): ?>
            <div class="text-center py-12">
                <i class="fas fa-inbox text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-slate-600 text-lg">No updates yet</p>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-6 bg-slate-50 border-l-4 border-blue-600 rounded-lg">
                        <!-- Update Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="font-semibold text-slate-800"><?php echo e($update->updatedBy->name); ?></p>
                                <small class="text-slate-600 flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <?php echo e($update->created_at->diffForHumans()); ?>

                                </small>
                            </div>
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                <?php if($update->status === 'completed'): ?> bg-green-100 text-green-800
                                <?php elseif($update->status === 'in_progress'): ?> bg-blue-100 text-blue-800
                                <?php elseif($update->status === 'to_do'): ?> bg-slate-100 text-slate-800
                                <?php elseif($update->status === 'review'): ?> bg-yellow-100 text-yellow-800
                                <?php endif; ?>">
                                <?php echo e(str_replace('_', ' ', ucfirst($update->status))); ?>

                            </span>
                        </div>

                        <!-- Notes -->
                        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap mb-4">
                            <?php echo e($update->notes); ?>

                        </p>

                        <!-- Image -->
                        <?php if($update->image_path): ?>
                            <a href="<?php echo e(asset('storage/' . $update->image_path)); ?>" target="_blank" class="inline-block mb-4">
                                <img src="<?php echo e(asset('storage/' . $update->image_path)); ?>" alt="Update" class="max-w-sm rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                            </a>
                        <?php endif; ?>

                        <!-- Files -->
                        <?php if($update->files->count() > 0): ?>
                            <div class="mt-4 pt-4 border-t border-slate-200">
                                <div class="font-semibold text-slate-800 mb-3 text-sm flex items-center gap-2">
                                    <i class="fas fa-file-download text-blue-600"></i>
                                    Files (<?php echo e($update->files->count()); ?>)
                                </div>
                                <div class="space-y-2">
                                    <?php $__currentLoopData = $update->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('task-files.download', $file)); ?>" class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200 text-slate-700">
                                            <i class="fas fa-file text-blue-600 text-lg"></i>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-medium truncate"><?php echo e($file->file_name); ?></div>
                                                <small class="text-slate-600 text-xs"><?php echo e($file->getFileSizeFormatted()); ?></small>
                                            </div>
                                            <i class="fas fa-download text-slate-400 text-sm"></i>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Back Button -->
<a href="<?php echo e(route('projects.show', $task->project)); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition-colors duration-200 mt-8">
    <i class="fas fa-arrow-left"></i> Back to Project
</a>
<?php $__env->stopSection(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/tasks/updates/show.blade.php ENDPATH**/ ?>