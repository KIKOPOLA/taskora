<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password - Taskora Project Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .confirm-container {
            width: 100%;
            max-width: 450px;
        }
        
        .confirm-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .confirm-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .confirm-header {
            text-align: center;
            margin-bottom: 0;
            padding-bottom: 25px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .logo {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
            padding: 12px;
            border-radius: 10px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        
        .logo img {
            max-width: 220px;
            height: auto;
            object-fit: contain;
        }
        
        .confirm-header h1 {
            font-size: 28px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .confirm-header p {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
            margin-top: 24px;
        }
        
        .form-group:first-of-type {
            margin-top: 24px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }
        
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            font-family: inherit;
            box-sizing: border-box;
            display: block;
            height: auto;
        }
        
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #f8faff;
        }
        
        input[type="password"]:hover {
            border-color: #d1d5db;
        }
        
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message i {
            color: #dc2626;
        }
        
        @media (max-width: 480px) {
            .confirm-card {
                padding: 30px;
            }
            
            .confirm-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="confirm-container">
        <!-- Confirm Password Card -->
        <div class="confirm-card">
            <!-- Logo/Branding Header -->
            <div class="confirm-header">
                <div class="logo">
                    <img src="<?php echo e(asset('images/Taskora Logo.png')); ?>" alt="Taskora Logo">
                </div>
                <h1>Confirm Password</h1>
                <p>This is a secure area. Please confirm your password to continue.</p>
            </div>
            
            <!-- Error Messages -->
            <?php if($errors->any()): ?>
                <div class="error-message">
                    <i class="fas fa-circle-exclamation"></i>
                    <div>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Confirm Password Form -->
            <form method="POST" action="<?php echo e(route('password.confirm')); ?>">
                <?php echo csrf_field(); ?>
                
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i>
                    Confirm
                </button>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\taskora\resources\views/auth/confirm-password.blade.php ENDPATH**/ ?>