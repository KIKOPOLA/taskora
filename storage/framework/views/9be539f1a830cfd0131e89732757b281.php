

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Project Portfolio</h1>
            <p class="text-slate-500 font-medium">Monitoring organizational initiatives and task delivery.</p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Project::class)): ?>
            <a href="<?php echo e(route('projects.create')); ?>"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Project</span>
            </a>
        <?php endif; ?>
    </div>

    <?php if($projects->isEmpty()): ?>
        <div class="bg-white rounded-3xl shadow-sm border border-blue-100 p-20 text-center">
            <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-folder-open text-3xl text-blue-200"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900">No Projects Found</h3>
            <p class="text-slate-500 font-medium max-w-sm mx-auto mt-2">Initialize your first workspace to start collaborating with your team.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 hover:border-blue-400 hover:shadow-xl hover:shadow-blue-500/5 transition-all flex flex-col h-full group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 -mr-12 -mt-12 rounded-full blur-2xl group-hover:bg-blue-100 transition-colors"></div>
                    
                    <div class="p-8 flex-1 relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest
                                        <?php if($project->status === 'completed'): ?> bg-emerald-50 text-emerald-700
                                        <?php elseif($project->status === 'in_progress'): ?> bg-blue-50 text-blue-700
                                        <?php elseif($project->status === 'on_hold'): ?> bg-rose-50 text-rose-700
                                        <?php else: ?> bg-slate-50 text-slate-500
                                        <?php endif; ?>">
                                <?php echo e(str_replace('_', ' ', $project->status)); ?>

                            </span>
                            <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">#<?php echo e($project->id); ?></span>
                        </div>

                        <a href="<?php echo e(route('projects.show', $project)); ?>" class="block mb-4">
                            <h3 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors leading-tight">
                                <?php echo e($project->name); ?></h3>
                        </a>
                        <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed h-10 font-medium"><?php echo e($project->description); ?></p>

                        <div class="flex items-center justify-between pt-6 mt-8 border-t border-slate-50">
                            <div class="flex items-center gap-5 text-slate-400">
                                <div class="flex items-center gap-2" title="Tasks">
                                    <i class="fas fa-check-circle text-blue-400 text-xs"></i>
                                    <span class="text-xs font-bold text-slate-600"><?php echo e($project->tasks->count()); ?></span>
                                </div>
                                <div class="flex items-center gap-2" title="Members">
                                    <i class="fas fa-users text-blue-400 text-xs"></i>
                                    <span class="text-xs font-bold text-slate-600"><?php echo e($project->members->count()); ?></span>
                                </div>
                            </div>

                            <div class="flex -space-x-2">
                                <?php $__currentLoopData = $project->members->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="w-7 h-7 rounded-lg bg-blue-50 border-2 border-white flex items-center justify-center text-[9px] font-bold text-blue-700 shadow-sm transition-transform group-hover:scale-110"
                                        title="<?php echo e($member->name); ?>">
                                        <?php echo e(strtoupper(substr($member->name, 0, 1))); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->members->count() > 3): ?>
                                    <div
                                        class="w-7 h-7 rounded-lg bg-slate-900 border-2 border-white flex items-center justify-center text-[9px] font-bold text-white shadow-sm">
                                        +<?php echo e($project->members->count() - 3); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo e(route('projects.show', $project)); ?>"
                        class="px-8 py-4 bg-slate-50 group-hover:bg-blue-600 group-hover:text-white border-t border-slate-50 text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] transition-all rounded-b-2xl">
                        Explore Project
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/projects/index.blade.php ENDPATH**/ ?>