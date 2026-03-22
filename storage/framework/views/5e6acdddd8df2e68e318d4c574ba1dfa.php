

<?php $__env->startSection('content'); ?>
    <!-- Navigation Breadcrumb -->
    <div class="mb-8">
        <a href="<?php echo e(route('projects.show', $task->project)); ?>"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Project: <?php echo e($task->project->name); ?></span>
        </a>
    </div>

    <!-- Task Overview -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-4">
                    <span
                        class="text-[10px] font-bold px-2 py-0.5 bg-slate-100 text-slate-600 rounded border border-slate-200 uppercase tracking-widest">#<?php echo e($task->id); ?></span>
                    <?php if($task->due_date && $task->due_date->isPast()): ?>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 bg-red-50 text-red-600 rounded border border-red-100 uppercase tracking-widest">Overdue</span>
                    <?php endif; ?>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-4"><?php echo e($task->title); ?></h1>
                <p class="text-slate-600 max-w-2xl leading-relaxed text-sm"><?php echo e($task->description); ?></p>
            </div>

            <div class="flex flex-col gap-2 min-w-[200px]">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $task)): ?>
                    <a href="<?php echo e(route('tasks.edit', $task)); ?>"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm active:scale-95">
                        <i class="fas fa-edit text-xs"></i>
                        <span>Edit Task</span>
                    </a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $task)): ?>
                    <form method="POST" action="<?php echo e(route('tasks.destroy', $task)); ?>" class="w-full"
                        onsubmit="return confirm('Are you sure you want to delete this task?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-2 bg-white hover:bg-red-50 text-red-600 rounded-lg font-bold text-sm border border-slate-200 hover:border-red-200 transition-all">
                            <i class="fas fa-trash text-xs"></i>
                            <span>Delete Task</span>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Key Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Status</p>
            <span class="text-xs font-bold uppercase tracking-wider
                <?php if($task->status === 'completed'): ?> text-emerald-600
                <?php elseif($task->status === 'in_progress'): ?> text-blue-600
                <?php elseif($task->status === 'to_do'): ?> text-slate-500
                <?php elseif($task->status === 'review'): ?> text-indigo-600
                <?php endif; ?>">
                <?php echo e(str_replace('_', ' ', $task->status)); ?>

            </span>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Priority</p>
            <span class="text-xs font-bold uppercase tracking-wider
                <?php if($task->priority === 'urgent'): ?> text-red-600
                <?php elseif($task->priority === 'high'): ?> text-orange-600
                <?php elseif($task->priority === 'medium'): ?> text-amber-600
                <?php elseif($task->priority === 'low'): ?> text-emerald-600
                <?php endif; ?>">
                <?php echo e($task->priority); ?>

            </span>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Assignee</p>
            <p class="text-sm font-bold text-slate-900"><?php echo e($task->assignee?->name ?? 'Unassigned'); ?></p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Due Date</p>
            <p class="text-sm font-bold text-slate-900">
                <?php echo e($task->due_date ? $task->due_date->format('d M, Y') : 'No Date'); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2 space-y-4">
            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                <i class="fas fa-history text-xs"></i>
                Activity History
            </h2>

            <?php $__empty_1 = true; $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded bg-slate-900 flex items-center justify-center text-white text-[10px] font-bold">
                                <?php echo e(strtoupper(substr($update->updatedBy->name, 0, 2))); ?>

                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900"><?php echo e($update->updatedBy->name); ?></p>
                                <p class="text-[10px] text-slate-400"><?php echo e($update->created_at->format('M d, Y H:i')); ?></p>
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold text-slate-400 uppercase"><?php echo e($update->created_at->diffForHumans()); ?></span>
                    </div>

                    <p class="text-slate-600 text-sm leading-relaxed mb-4"><?php echo e($update->notes); ?></p>

                    <?php if($update->image_path): ?>
                        <div class="mb-4 rounded-lg overflow-hidden border border-slate-100 bg-slate-50">
                            <a href="<?php echo e(asset('storage/' . $update->image_path)); ?>" target="_blank">
                                <img src="<?php echo e(asset('storage/' . $update->image_path)); ?>" class="w-full max-h-96 object-contain">
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if($update->files->count() > 0): ?>
                        <div class="flex flex-wrap gap-2">
                            <?php $__currentLoopData = $update->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('task-files.download', $file)); ?>"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded text-[10px] font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                                    <i class="fas fa-file-download text-slate-400"></i>
                                    <?php echo e($file->file_name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-slate-50 rounded-xl border border-dashed border-slate-200 p-12 text-center text-slate-400">
                    <p class="text-sm font-medium">No activity recorded yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="space-y-6">
            <?php if(auth()->user()->role === 'member' && $task->assigned_to === auth()->id()): ?>
                <div class="bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-6 border border-blue-200 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <i class="fas fa-cloud-upload-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Upload Progress</h3>
                            <p class="text-xs text-gray-500">Share your work updates</p>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('task-updates.store', $task)); ?>" enctype="multipart/form-data"
                        class="space-y-5">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Notes Input -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                <i class="fas fa-comment-dots text-blue-500 mr-1"></i>
                                Progress Notes
                            </label>
                            <textarea name="notes" rows="4" required
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all"
                                placeholder="Describe what you've accomplished..."></textarea>
                        </div>

                        <!-- Status Update -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                <i class="fas fa-tasks text-emerald-500 mr-1"></i>
                                Update Status
                            </label>
                            <select name="status" required
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm font-semibold transition-all">
                                <option value="to_do">📋 Backlog</option>
                                <option value="in_progress" selected>⚡ In Progress</option>
                                <option value="review">👀 Under Review</option>
                                <option value="completed">✅ Completed</option>
                            </select>
                        </div>

                        <!-- File Upload Section -->
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Image Upload -->
                            <label class="group cursor-pointer">
                                <div class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 hover:bg-blue-50/50 transition-all">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform shadow-lg shadow-purple-500/30">
                                        <i class="fas fa-image text-white text-lg"></i>
                                    </div>
                                    <span class="text-xs font-bold text-gray-700">Upload Image</span>
                                    <span class="text-[10px] text-gray-400 mt-1">JPG, PNG (Max 2MB)</span>
                                    <input type="file" name="image" accept="image/*" class="hidden" id="imageInput">
                                </div>
                                <div id="imagePreview" class="hidden mt-2 rounded-lg overflow-hidden border-2 border-gray-200">
                                    <img src="" alt="Preview" class="w-full h-32 object-cover">
                                </div>
                            </label>

                            <!-- Files Upload -->
                            <label class="group cursor-pointer">
                                <div class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-emerald-400 hover:bg-emerald-50/50 transition-all">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform shadow-lg shadow-emerald-500/30">
                                        <i class="fas fa-paperclip text-white text-lg"></i>
                                    </div>
                                    <span class="text-xs font-bold text-gray-700">Attach Files</span>
                                    <span class="text-[10px] text-gray-400 mt-1">PDF, DOC, etc (Max 10MB)</span>
                                    <input type="file" name="files[]" multiple class="hidden" id="filesInput">
                                </div>
                                <div id="filesPreview" class="hidden mt-2 space-y-1"></div>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-bold text-sm uppercase tracking-widest shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all transform hover:scale-[1.02] active:scale-95">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Post Update
                        </button>
                    </form>
                </div>

                <!-- Add Preview JavaScript -->
                <script>
                    // Image Preview
                    document.getElementById('imageInput').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = document.getElementById('imagePreview');
                                preview.querySelector('img').src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    });

                    // Files Preview
                    document.getElementById('filesInput').addEventListener('change', function(e) {
                        const files = e.target.files;
                        const preview = document.getElementById('filesPreview');
                        preview.innerHTML = '';
                        
                        if (files.length > 0) {
                            preview.classList.remove('hidden');
                            Array.from(files).forEach(file => {
                                const fileItem = document.createElement('div');
                                fileItem.className = 'flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs';
                                fileItem.innerHTML = `
                                    <i class="fas fa-file text-gray-400"></i>
                                    <span class="flex-1 truncate font-semibold text-gray-700">${file.name}</span>
                                    <span class="text-gray-400">${(file.size / 1024).toFixed(1)}KB</span>
                                `;
                                preview.appendChild(fileItem);
                            });
                        }
                    });
                </script>
            <?php endif; ?>

            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">
                    Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-[10px]">
                        <span class="font-bold text-slate-400 uppercase">Task ID</span>
                        <span class="font-bold text-slate-900">#<?php echo e($task->id); ?></span>
                    </div>
                    <div class="flex justify-between text-[10px]">
                        <span class="font-bold text-slate-400 uppercase">Created</span>
                        <span class="font-bold text-slate-900"><?php echo e($task->created_at->format('M d, Y')); ?></span>
                    </div>
                    <div class="flex justify-between text-[10px]">
                        <span class="font-bold text-slate-400 uppercase">Updates</span>
                        <span class="font-bold text-slate-900"><?php echo e($updates->count()); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/tasks/show.blade.php ENDPATH**/ ?>