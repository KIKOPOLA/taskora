

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('tasks.index')); ?>"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200 mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Return to Active Directory</span>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Assignment Origination</h1>
        <p class="text-slate-500 mt-1">Select the operational venture requiring new task parameters</p>
    </div>

    <!-- Projects Selection Ledger -->
    <div class="max-w-4xl">
        <div class="grid gap-6">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('tasks.create', $project)); ?>"
                    class="group block bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-500 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="text-[10px] font-bold px-2 py-0.5 bg-slate-100 text-slate-600 rounded uppercase tracking-widest border border-slate-200 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition-colors">Venture
                                    #<?php echo e($project->id); ?></span>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 mb-2">
                                <?php echo e($project->name); ?>

                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-2xl">
                                <?php if($project->description): ?>
                                    <?php echo e(Str::limit($project->description, 120)); ?>

                                <?php else: ?>
                                    <span class="text-slate-400 italic font-medium">No specialized documentation provided for this
                                        venture.</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <i class="fas fa-plus text-sm"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative background icon -->
                    <i
                        class="fas fa-folder absolute -bottom-4 -right-4 text-7xl text-slate-50 opacity-50 group-hover:text-blue-50 group-hover:scale-110 transition-all"></i>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($projects->isEmpty()): ?>
            <div class="bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 p-20 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-folder-open text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-400 mb-1">No accessible ventures found</h3>
                <p class="text-sm text-slate-400">Assignment origination requires an active pre-existing venture.</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/tasks/create-select-project.blade.php ENDPATH**/ ?>