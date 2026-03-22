

<?php $__env->startSection('content'); ?>
<style>
    .form-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
    }
    
    .form-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    
    .form-header .project-name {
        color: #e0f2fe;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }
    
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        max-width: 700px;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #1e3a8a;
        font-size: 0.95rem;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-family: inherit;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-group textarea {
        resize: vertical;
    }
    
    .form-group small {
        color: #6b7280;
        display: block;
        margin-top: 0.35rem;
        font-size: 0.8rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #3b82f6 0%, #0284c7 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    
    .btn-back {
        background: white;
        color: #1e3a8a;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        border-color: #1e3a8a;
        background: #f0f9ff;
    }
</style>

<div class="form-header">
    <h1><i class="fas fa-edit" style="margin-right: 0.5rem;"></i>Edit Project</h1>
    <div class="project-name"><?php echo e($project->name); ?></div>
</div>

<div class="form-card">
    <form action="<?php echo e(route('projects.update', $project)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="name">Project Name <span style="color: #ef4444;">*</span></label>
            <input type="text" id="name" name="name" required value="<?php echo e(old('name', $project->name)); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #ef4444;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?php echo e(old('description', $project->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #ef4444;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="status">Status <span style="color: #ef4444;">*</span></label>
            <select id="status" name="status" required>
                <option value="planning" <?php if($project->status == 'planning'): ?> selected <?php endif; ?>>Planning</option>
                <option value="ongoing" <?php if($project->status == 'ongoing'): ?> selected <?php endif; ?>>Ongoing</option>
                <option value="completed" <?php if($project->status == 'completed'): ?> selected <?php endif; ?>>Completed</option>
                <option value="on_hold" <?php if($project->status == 'on_hold'): ?> selected <?php endif; ?>>On Hold</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo e(old('start_date', $project->start_date?->format('Y-m-d'))); ?>">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo e(old('end_date', $project->end_date?->format('Y-m-d'))); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="members">Team Members</label>
            <select id="members" name="members[]" multiple style="height: 180px;">
                <?php $__currentLoopData = $availableMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($member->id); ?>" <?php if(in_array($member->id, $currentMembers)): ?> selected <?php endif; ?>>
                        <?php echo e($member->name); ?> (<?php echo e($member->email); ?>)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small>Hold Ctrl/Cmd to select multiple members</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save" style="margin-right: 0.5rem;"></i>Save Changes
            </button>
            <a href="<?php echo e(route('projects.show', $project)); ?>" class="btn-back">
                <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i>Back
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\taskora\resources\views/projects/edit.blade.php ENDPATH**/ ?>