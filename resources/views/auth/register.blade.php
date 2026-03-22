<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Taskora Project Management</title>
    
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
        
        .register-container {
            width: 100%;
            max-width: 450px;
        }
        
        .register-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .register-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .register-header {
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
        
        .register-header h1 {
            font-size: 28px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        
        .register-header p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }
        
        input[type="text"],
        input[type="email"],
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
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #f8faff;
        }
        
        input[type="text"]:hover,
        input[type="email"]:hover,
        input[type="password"]:hover {
            border-color: #d1d5db;
        }
        
        .password-group {
            position: relative;
            display: block;
            width: 100%;
            height: 48px;
        }
        
        .password-group input {
            width: 100% !important;
            height: 48px !important;
            padding: 12px 14px !important;
            box-sizing: border-box !important;
            line-height: 24px !important;
        }
        
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            font-size: 16px;
            padding: 0;
            margin: 0;
            width: 20px;
            height: 20px;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        
        .toggle-password i {
            transition: opacity 0.2s ease, transform 0.2s ease;
            display: block;
        }
        
        .toggle-password:hover {
            color: #3b82f6;
            transform: translateY(-50%) scale(1.1);
        }
        
        .toggle-password:active {
            transform: translateY(-50%) scale(0.95);
        }
        
        .btn-register {
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
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #d1d5db;
            font-size: 13px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        }
        
        .login-prompt {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        
        .login-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .login-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }
        
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message i {
            color: #dc2626;
        }
        
        .info-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-left: 4px solid #0284c7;
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 12px;
            color: #0c4a6e;
        }
        
        .info-box i {
            color: #0284c7;
            margin-right: 6px;
        }
        
        .password-requirements {
            margin-top: 8px;
            font-size: 11px;
            color: #075985;
        }
        
        .password-requirements ul {
            list-style: none;
            margin-top: 6px;
            padding-left: 16px;
        }
        
        .password-requirements li::before {
            content: '✓ ';
            color: #0284c7;
            font-weight: bold;
            margin-right: 4px;
        }
        
        @media (max-width: 480px) {
            .register-card {
                padding: 30px;
            }
            
            .register-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Register Card -->
        <div class="register-card">
            <!-- Logo/Branding Header -->
            <div class="register-header">
                <div class="logo">
                    <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo">
                </div>
                <h1>Create Account</h1>
                <p>Join Taskora and start managing projects</p>
            </div>
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    <i class="fas fa-circle-exclamation"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name Input -->
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user" style="color: #3b82f6; margin-right: 6px;"></i>
                        Full Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Nama Lengkap"
                        required 
                        autofocus
                    >
                </div>
                
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope" style="color: #3b82f6; margin-right: 6px;"></i>
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Email Address"
                        required
                    >
                </div>
                
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Confirm Password Input -->
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Confirm Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Register Button -->
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>
            
            <!-- Divider -->
            <div class="divider">or</div>
            
            <!-- Login Link -->
            <div class="login-prompt">
                Already have an account?
                <a href="{{ route('login') }}" class="login-link">
                    Sign in here
                </a>
            </div>
            
            <!-- Info Box -->
            <div class="info-box">
                <div><i class="fas fa-info-circle"></i> <strong>Account Status</strong></div>
                <div class="password-requirements">
                    Your account will be created as <strong>inactive</strong> by default and must be approved by an administrator before you can log in.
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = event.target.closest('.toggle-password');
            const icon = button.querySelector('i');
            
            // Animate icon out
            icon.style.opacity = '0.3';
            icon.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
                
                // Animate icon back in
                icon.style.opacity = '1';
                icon.style.transform = 'scale(1)';
            }, 100);
        }
    </script>
</body>
</html>
